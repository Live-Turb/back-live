<?php

namespace App\Services;

use App\Models\User;
use App\Models\ViewBillingRecord;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Log;
use App\Services\ViewTrackingService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Events\PaymentProcessed as PaymentProcessedEvent;
use App\Events\PaymentProcessingFailed;
use App\Notifications\PaymentProcessed as PaymentProcessedNotification;
use App\Notifications\PaymentFailed;

class StripeChargeService
{
    protected $stripe;

    public function __construct()
    {
        $stripeSecret = config('services.stripe.secret');
        if (!$stripeSecret) {
            throw new \InvalidArgumentException('Stripe secret key is not configured');
        }
        $this->stripe = new \Stripe\StripeClient($stripeSecret);
    }

    /**
     * Retorna a instância do cliente Stripe
     */
    public function getStripe()
    {
        return $this->stripe;
    }

    /**
     * Cria uma cobrança para visualizações extras
     */
    public function createExtraViewsCharge(ViewBillingRecord $billingRecord)
    {
        try {
            Log::info('Iniciando criação de cobrança:', [
                'billing_record_id' => $billingRecord->id,
                'user_id' => $billingRecord->user_id,
                'amount' => $billingRecord->extra_views_cost
            ]);

            $user = User::findOrFail($billingRecord->user_id);
            $amount = (int)($billingRecord->extra_views_cost * 100); // Converte para centavos

            Log::info('Buscando/criando cliente no Stripe');
            // Cria ou recupera o cliente no Stripe
            $stripeCustomer = $this->getOrCreateStripeCustomer($user);
            Log::info('Cliente Stripe:', ['customer_id' => $stripeCustomer->id]);

            Log::info('Criando PaymentIntent');
            // Cria a intent de pagamento
            $paymentIntent = $this->stripe->paymentIntents->create([
                'amount' => $amount,
                'currency' => 'brl',
                'customer' => $stripeCustomer->id,
                'description' => sprintf(
                    'Cobrança de %d visualizações extras - Período: %s a %s',
                    $billingRecord->extra_views,
                    $billingRecord->billing_period_start->format('d/m/Y'),
                    $billingRecord->billing_period_end->format('d/m/Y')
                ),
                'metadata' => [
                    'billing_record_id' => $billingRecord->id,
                    'user_id' => $user->id,
                    'extra_views' => $billingRecord->extra_views
                ],
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);
            Log::info('PaymentIntent criado:', ['payment_intent_id' => $paymentIntent->id]);

            return [
                'success' => true,
                'client_secret' => $paymentIntent->client_secret,
                'payment_intent_id' => $paymentIntent->id
            ];

        } catch (\Exception $e) {
            Log::error('Erro ao criar cobrança no Stripe:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'billing_record_id' => $billingRecord->id
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Processa eventos do webhook do Stripe
     */
    public function handlePaymentWebhook($event)
    {
        Log::info('Processando evento do Stripe:', [
            'type' => $event->type,
            'id' => $event->id
        ]);

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $this->handlePaymentSuccess($event->data->object);
                break;

            case 'payment_intent.payment_failed':
                $this->handlePaymentFailure($event->data->object);
                break;
        }
    }

    /**
     * Processa pagamento bem-sucedido
     */
    protected function handlePaymentSuccess($paymentIntent)
    {
        $lockKey = "payment_processing_{$paymentIntent->id}";
        try {
            // Tenta obter lock para evitar processamento duplicado
            $lock = Cache::lock($lockKey, 10);
            if (!$lock->get()) {
                throw new \Exception('Pagamento já está sendo processado');
            }

            Log::info('Iniciando processamento de pagamento:', [
                'payment_intent_id' => $paymentIntent->id,
                'amount' => $paymentIntent->amount / 100,
                'currency' => $paymentIntent->currency
            ]);

            // Busca o registro de cobrança pelo metadata com retry
            $billingRecord = $this->getBillingRecordWithRetry($paymentIntent);

            // Registra estado anterior para auditoria
            $previousState = [
                'status' => $billingRecord->status,
                'processed_at' => $billingRecord->processed_at,
                'notes' => $billingRecord->notes
            ];

            return DB::transaction(function() use ($paymentIntent, $billingRecord, $previousState) {
                // Atualiza o status do registro com lock
                $billingRecord = ViewBillingRecord::where('id', $billingRecord->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                // Previne processamento duplicado
                if ($billingRecord->status === 'processed') {
                    Log::warning('Tentativa de processar pagamento já processado', [
                        'billing_record_id' => $billingRecord->id,
                        'payment_intent_id' => $paymentIntent->id
                    ]);
                    return;
                }

                $paymentAmount = $paymentIntent->amount / 100;

                // Atualiza o registro com informações detalhadas
                $billingRecord->update([
                    'status' => 'processed',
                    'processed_at' => now(),
                    'payment_intent_id' => $paymentIntent->id,
                    'payment_amount' => $paymentAmount,
                    'notes' => json_encode([
                        'payment_intent_id' => $paymentIntent->id,
                        'processed_at' => now()->format('Y-m-d H:i:s'),
                        'amount' => $paymentAmount,
                        'currency' => $paymentIntent->currency,
                        'previous_state' => $previousState,
                        'timezone' => now()->timezone->getName()
                    ])
                ]);

                // Reseta visualizações com o valor do pagamento
                $viewTrackingService = app(ViewTrackingService::class);
                $resetSuccess = $viewTrackingService->resetExtraViews(
                    $billingRecord->user_id,
                    $paymentAmount
                );

                if (!$resetSuccess) {
                    throw new \Exception('Falha ao resetar visualizações após pagamento');
                }

                // Envia notificação de sucesso
                $user = \App\Models\User::find($billingRecord->user_id);
                $user->notify(new \App\Notifications\PaymentProcessedNotification($billingRecord, $paymentIntent));

                Log::info('Pagamento processado com sucesso', [
                    'billing_record_id' => $billingRecord->id,
                    'payment_intent_id' => $paymentIntent->id,
                    'amount' => $paymentAmount
                ]);

                // Dispara evento de pagamento processado
                event(new \App\Events\PaymentProcessedEvent($billingRecord, $paymentIntent));

                return true;
            });

        } catch (\Exception $e) {
            Log::error('Erro ao processar pagamento:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'payment_intent_id' => $paymentIntent->id ?? null
            ]);

            // Notifica erro para monitoramento
            event(new \App\Events\PaymentProcessingFailed($paymentIntent, $e));
            
            throw $e;
        } finally {
            if (isset($lock)) {
                $lock->release();
            }
        }
    }

    /**
     * Busca registro de cobrança com retry em caso de race condition
     */
    private function getBillingRecordWithRetry($paymentIntent, $maxAttempts = 3)
    {
        $attempts = 0;
        $lastError = null;

        while ($attempts < $maxAttempts) {
            try {
                $billingRecordId = $paymentIntent->metadata->billing_record_id ?? null;
                if (!$billingRecordId) {
                    throw new \Exception('ID do registro de cobrança não encontrado no metadata');
                }

                $billingRecord = ViewBillingRecord::find($billingRecordId);
                if (!$billingRecord) {
                    throw new \Exception('Registro de cobrança não encontrado');
                }

                return $billingRecord;

            } catch (\Exception $e) {
                $lastError = $e;
                $attempts++;
                
                if ($attempts < $maxAttempts) {
                    Log::warning("Tentativa {$attempts} de buscar registro de cobrança falhou", [
                        'payment_intent_id' => $paymentIntent->id,
                        'error' => $e->getMessage()
                    ]);
                    sleep(1);
                }
            }
        }

        throw new \Exception(
            'Falha ao buscar registro de cobrança após ' . $maxAttempts . ' tentativas: ' . 
            $lastError->getMessage()
        );
    }

    /**
     * Processa falha no pagamento
     */
    protected function handlePaymentFailure($paymentIntent)
    {
        try {
            Log::info('Processando falha no pagamento:', [
                'payment_intent_id' => $paymentIntent->id
            ]);

            // Busca o registro de cobrança pelo metadata
            $billingRecordId = $paymentIntent->metadata->billing_record_id ?? null;
            if (!$billingRecordId) {
                throw new \Exception('ID do registro de cobrança não encontrado no metadata');
            }

            $billingRecord = ViewBillingRecord::find($billingRecordId);
            if (!$billingRecord) {
                throw new \Exception('Registro de cobrança não encontrado');
            }

            // Atualiza o status do registro
            $billingRecord->update([
                'status' => 'failed',
                'notes' => json_encode([
                    'payment_intent_id' => $paymentIntent->id,
                    'failed_at' => now()->format('Y-m-d H:i:s'),
                    'error' => $paymentIntent->last_payment_error->message ?? 'Erro desconhecido'
                ])
            ]);

            // Envia notificação de falha
            $user = \App\Models\User::find($billingRecord->user_id);
            $user->notify(new \App\Notifications\PaymentFailed(
                $billingRecord,
                $paymentIntent->last_payment_error->message ?? 'Erro desconhecido'
            ));

            Log::info('Falha no pagamento registrada', [
                'billing_record_id' => $billingRecord->id,
                'payment_intent_id' => $paymentIntent->id
            ]);

        } catch (\Exception $e) {
            Log::error('Erro ao processar falha no pagamento:', [
                'error' => $e->getMessage(),
                'payment_intent_id' => $paymentIntent->id ?? null
            ]);
            throw $e;
        }
    }

    /**
     * Obtém ou cria um cliente no Stripe
     */
    protected function getOrCreateStripeCustomer(User $user)
    {
        if ($user->stripe_id) {
            try {
                return $this->stripe->customers->retrieve($user->stripe_id);
            } catch (\Exception $e) {
                // Se o cliente não existir mais no Stripe, cria um novo
            }
        }

        // Cria um novo cliente no Stripe
        $customer = $this->stripe->customers->create([
            'email' => $user->email,
            'name' => $user->name,
            'metadata' => [
                'user_id' => $user->id
            ]
        ]);

        // Salva o ID do cliente do Stripe no usuário
        $user->update(['stripe_id' => $customer->id]);

        return $customer;
    }
}
