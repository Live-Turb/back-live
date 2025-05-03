<?php

namespace App\Listeners;

use App\Events\ProcessExtraViewsPayment;
use App\Models\ViewBillingRecord;
use App\Services\StripeChargeService;
use Illuminate\Support\Facades\Log;

class ProcessExtraViewsPaymentListener
{
    protected $stripeService;

    public function __construct(StripeChargeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function handle(ProcessExtraViewsPayment $event)
    {
        try {
            Log::info('Processando pagamento automático de visualizações extras', [
                'user_id' => $event->userId
            ]);

            // Busca registros pendentes
            $pendingRecords = ViewBillingRecord::where('user_id', $event->userId)
                ->where('status', 'pending')
                ->orderBy('created_at', 'asc')
                ->get();

            foreach ($pendingRecords as $record) {
                // Tenta criar a cobrança
                $chargeResult = $this->stripeService->createExtraViewsCharge($record);

                if ($chargeResult['success']) {
                    Log::info('Cobrança criada com sucesso', [
                        'billing_record_id' => $record->id,
                        'payment_intent_id' => $chargeResult['payment_intent_id']
                    ]);
                } else {
                    Log::error('Falha ao criar cobrança', [
                        'billing_record_id' => $record->id,
                        'error' => $chargeResult['error']
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Erro ao processar pagamento automático', [
                'user_id' => $event->userId,
                'error' => $e->getMessage()
            ]);
        }
    }
}
