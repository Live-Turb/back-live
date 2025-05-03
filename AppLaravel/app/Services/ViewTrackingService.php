<?php

namespace App\Services;

use App\Models\ViewStatistic;
use App\Models\TemplateView;
use App\Models\ViewBillingRecord;
use App\Models\UserBillingControl;
use App\Models\User;
use App\Models\Subscription;
use App\Exceptions\BillingException;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class ViewTrackingService
{
    const BASIC_PLAN_VIEWS = 6000; // Limite do plano básico (mantido para compatibilidade)
    const STANDARD_PLAN_VIEWS = 25000; // Limite do plano padrão
    const PREMIUM_PLAN_VIEWS = 50000; // Limite do plano premium
    const EXTRA_VIEW_COST = 0.02; // Custo por visualização extra (em reais)
    const EXTRA_VIEWS_BLOCK_SIZE = 2500; // Tamanho do bloco de cobrança
    const MAX_UNPAID_EXTRA_VIEWS = 5000; // Limite máximo de visualizações extras não pagas
    const MAX_PENDING_AMOUNT = 100.00; // Valor máximo pendente permitido
    const AUTO_CHARGE_THRESHOLD = 50.00; // Valor para cobrança automática

    public function recordView($templateId, $userId, Request $request)
    {
        try {
            // Verifica se o usuário está bloqueado antes de iniciar a transação
            $billingControl = Cache::remember("billing_control_{$userId}", 60, function() use ($userId, $request) {
                return UserBillingControl::firstOrCreate(
                    ['user_id' => $userId],
                    [
                        'pending_amount' => 0,
                        'is_blocked' => false,
                        'last_ip' => $request->ip(),
                        'device_fingerprint' => md5($request->userAgent())
                    ]
                );
            });

            DB::beginTransaction();

            // Obtém o limite de views do plano atual
            $planViewsLimit = $this->getUserPlanViewsLimit($userId);

            // Obtém o total de visualizações do mês atual
            $currentMonthViews = Cache::remember("views_count_{$userId}_" . date('Ym'), 60, function() use ($userId) {
                return ViewStatistic::where('user_id', $userId)
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count();
            });

            // Obtém o total de visualizações já processadas/pagas
            $processedViews = ViewBillingRecord::where('user_id', $userId)
                ->where('billing_period_start', '<=', now())
                ->where('billing_period_end', '>=', now())
                ->where('status', 'processed')
                ->sum('extra_views');

            // Obtém o total de visualizações pendentes
            $pendingViews = ViewBillingRecord::where('user_id', $userId)
                ->where('billing_period_start', '<=', now())
                ->where('billing_period_end', '>=', now())
                ->where('status', 'pending')
                ->sum('extra_views');

            // Calcula visualizações extras totais usando o limite do plano atual
            $totalExtraViews = max(0, $currentMonthViews + 1 - $planViewsLimit);
            
            // Calcula visualizações extras não processadas
            $unpaidExtraViews = max(0, $totalExtraViews - $processedViews);

            // Verifica se precisa criar um novo bloco de cobrança
            if ($unpaidExtraViews > 0 && $unpaidExtraViews % self::EXTRA_VIEWS_BLOCK_SIZE == 0) {
                // Cria um novo registro de cobrança para o bloco atual
                ViewBillingRecord::create([
                    'user_id' => $userId,
                    'billing_period_start' => now()->startOfMonth(),
                    'billing_period_end' => now()->endOfMonth(),
                    'total_views' => self::EXTRA_VIEWS_BLOCK_SIZE,
                    'extra_views' => self::EXTRA_VIEWS_BLOCK_SIZE,
                    'extra_views_cost' => self::EXTRA_VIEWS_BLOCK_SIZE * self::EXTRA_VIEW_COST,
                    'status' => 'pending',
                    'notes' => json_encode([
                        'charge_type' => 'auto_block',
                        'block_size' => self::EXTRA_VIEWS_BLOCK_SIZE,
                        'block_number' => floor($unpaidExtraViews / self::EXTRA_VIEWS_BLOCK_SIZE)
                    ])
                ]);

                // Atualiza o valor pendente no controle de billing
                $billingControl->update([
                    'pending_amount' => $pendingViews * self::EXTRA_VIEW_COST
                ]);

                // Tenta processar a cobrança automaticamente
                event(new \App\Events\ProcessExtraViewsPayment($userId));
            }

            // Verifica se deve bloquear o usuário
            if ($pendingViews >= self::MAX_UNPAID_EXTRA_VIEWS) {
                $billingControl->update([
                    'is_blocked' => true,
                    'block_reason' => 'Limite máximo de visualizações extras não pagas atingido (' . self::MAX_UNPAID_EXTRA_VIEWS . ' visualizações)'
                ]);

                Cache::forget("billing_control_{$userId}");
                Cache::forget("views_count_{$userId}_" . date('Ym'));
                
                throw new BillingException(
                    'Limite máximo de visualizações extras não pagas atingido',
                    'billing_limit_exceeded'
                );
            }

            // Registra a visualização
            $agent = new Agent();
            $agent->setUserAgent($request->userAgent());

            // Cria o registro de visualização
            ViewStatistic::create([
                'user_id' => $userId,
                'template_id' => $templateId,
                'viewer_ip' => $request->ip(),
                'viewer_session' => session()->getId(),
                'device_type' => $this->getDeviceType($agent),
                'browser' => $agent->browser(),
                'os' => $agent->platform(),
                'is_unique' => $this->isUniqueView($templateId, $request->ip()),
                'user_agent' => $request->userAgent()
            ]);

            DB::commit();
            return true;

        } catch (BillingException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erro ao registrar visualização: ' . $e->getMessage(), [
                'user_id' => $userId,
                'template_id' => $templateId,
                'exception' => $e
            ]);
            throw new \Exception('Erro ao registrar visualização');
        }
    }

    public function getUserPlanViewsLimit($userId)
    {
        return Cache::remember("user_plan_views_limit_{$userId}", 60, function() use ($userId) {
            $subscription = Subscription::where('user_id', $userId)
                ->where('status', 'ACTIVE')
                // Removido a verificação de expire_date
                ->with('paypalPlan')
                ->orderBy('created_at', 'desc')  // Pega a assinatura mais recente
                ->first();

            if ($subscription && $subscription->paypalPlan) {
                $planName = strtolower($subscription->paypalPlan->name);
                $limit = match($planName) {
                    'basic' => self::BASIC_PLAN_VIEWS,
                    'standard' => self::STANDARD_PLAN_VIEWS,
                    'premium' => self::PREMIUM_PLAN_VIEWS,
                    default => self::BASIC_PLAN_VIEWS
                };
                info("User {$userId} plan: {$subscription->paypalPlan->name} with limit: {$limit}");
                return $limit;
            }

            info("User {$userId} using default Basic plan limit: " . self::BASIC_PLAN_VIEWS);
            return self::BASIC_PLAN_VIEWS;
        });
    }

    protected function isUniqueView($templateId, $ip)
    {
        $cacheKey = "unique_view_{$templateId}_{$ip}";
        return Cache::remember($cacheKey, 1440, function() use ($templateId, $ip) {
            return !ViewStatistic::where('template_id', $templateId)
                ->where('viewer_ip', $ip)
                ->where('created_at', '>=', Carbon::now()->subDay())
                ->exists();
        });
    }

    protected function getDeviceType($agent)
    {
        if ($agent->isTablet()) return 'tablet';
        if ($agent->isMobile()) return 'mobile';
        return 'desktop';
    }

    /**
     * Verifica o limite de visualizações do usuário
     * @param int $userId ID do usuário
     * @return array Informações sobre as visualizações do usuário
     */
    public function checkViewsLimit($userId)
    {
        $user = User::findOrFail($userId);
        $subscription = Subscription::where('user_id', $userId)
            ->where('status', 'ACTIVE')
            ->first();

        $totalViews = $this->getTotalViews($userId);
        $hasSubscription = !is_null($subscription);
        $planViewsLimit = $this->getUserPlanViewsLimit($userId);
        $extraViews = max(0, $totalViews - $planViewsLimit);
        
        // Calcula o custo das visualizações extras
        $extraViewsCost = 0;
        if ($extraViews > 0) {
            $extraViewsCost = $extraViews * self::EXTRA_VIEW_COST;
        }

        // Verifica se o usuário está bloqueado
        $billingControl = UserBillingControl::firstOrCreate(
            ['user_id' => $userId],
            [
                'pending_amount' => 0,
                'is_blocked' => false,
                'last_ip' => request()->ip(),
                'device_fingerprint' => md5(request()->userAgent() . request()->ip())
            ]
        );

        // Calcula visualizações restantes
        $remaining = max(0, $planViewsLimit - $totalViews);

        // Calcula blocos completos e valor restante
        $completeBlocks = floor($extraViewsCost / self::EXTRA_VIEWS_BLOCK_SIZE);
        $remainingValue = $extraViewsCost - ($completeBlocks * self::EXTRA_VIEWS_BLOCK_SIZE);

        return [
            'current' => $totalViews,
            'limit' => $planViewsLimit,
            'remaining' => $remaining,
            'extra_views' => $extraViews,
            'extra_cost' => $extraViewsCost,
            'complete_blocks' => $completeBlocks,
            'remaining_block_value' => $remainingValue,
            'has_subscription' => $hasSubscription,
            'is_blocked' => $billingControl->is_blocked,
            'pending_amount' => $billingControl->pending_amount,
            'block_reason' => $billingControl->block_reason,
            'plan_name' => $subscription ? $subscription->plan_name : 'Basic',
            'is_exceeded' => $extraViews > 0,
            'cost_per_view' => self::EXTRA_VIEW_COST,
            'block_value' => self::EXTRA_VIEWS_BLOCK_SIZE
        ];
    }

    /**
     * Obtém o total de visualizações desde o último reset
     */
    protected function getTotalViews($userId)
    {
        // Encontra o último reset
        $lastReset = ViewStatistic::where('user_id', $userId)
            ->where('template_id', 0)
            ->where('viewer_session', 'like', 'reset_%')
            ->orderBy('created_at', 'desc')
            ->first();

        $query = ViewStatistic::where('user_id', $userId)
            ->where('template_id', '>', 0); // Ignora registros de sistema

        if ($lastReset) {
            // Conta apenas visualizações após o último reset
            $query->where('created_at', '>', $lastReset->created_at);
        } else {
            // Se não houver reset, conta visualizações do mês atual
            $query->whereMonth('created_at', now()->month)
                  ->whereYear('created_at', now()->year);
        }

        return $query->count();
    }

    /**
     * Método público para obter o total de visualizações
     */
    public function getCurrentViews($userId)
    {
        return $this->getTotalViews($userId);
    }

    /**
     * Reseta as visualizações extras após o pagamento
     * @param int $userId ID do usuário
     * @param float $paymentAmount Valor do pagamento
     * @return bool
     */
    public function resetExtraViews($userId, $paymentAmount)
    {
        $lockKey = "billing_reset_{$userId}";
        try {
            // Tenta obter o lock por 10 segundos
            $lock = Cache::lock($lockKey, 10);
            
            if (!$lock->get()) {
                Log::error('Não foi possível obter lock para reset', [
                    'user_id' => $userId,
                    'payment_amount' => $paymentAmount
                ]);
                return false;
            }

            return DB::transaction(function() use ($userId, $paymentAmount) {
                // Obtém o controle de billing com lock
                $billingControl = UserBillingControl::where('user_id', $userId)
                    ->lockForUpdate()
                    ->firstOrFail();

                // Valida se o valor pago é suficiente
                if ($paymentAmount < $billingControl->pending_amount) {
                    throw new \Exception('Valor pago insuficiente para desbloqueio');
                }

                // Registra estado anterior para auditoria
                $previousState = [
                    'pending_amount' => $billingControl->pending_amount,
                    'is_blocked' => $billingControl->is_blocked,
                    'block_reason' => $billingControl->block_reason,
                    'timezone' => now()->timezone->getName()
                ];

                // Arquiva registros antigos ao invés de deletar
                ViewBillingRecord::where('user_id', $userId)
                    ->where(function($query) {
                        $query->where('status', 'pending')
                              ->orWhere('created_at', '<', now()->startOfMonth());
                    })
                    ->update([
                        'status' => 'archived',
                        'archived_at' => now(),
                        'archived_reason' => 'payment_processed',
                        'previous_state' => json_encode($previousState)
                    ]);

                // Atualiza o controle de billing
                $billingControl->update([
                    'pending_amount' => max(0, $billingControl->pending_amount - $paymentAmount),
                    'is_blocked' => false,
                    'block_reason' => null,
                    'last_billing_check' => now(),
                    'last_payment_amount' => $paymentAmount,
                    'last_payment_date' => now()
                ]);

                // Limpa todos os caches relacionados
                $this->clearUserCaches($userId);

                // Registra o reset no histórico
                ViewStatistic::create([
                    'user_id' => $userId,
                    'template_id' => 0,
                    'viewer_ip' => request()->ip(),
                    'viewer_session' => 'reset_' . time(),
                    'device_type' => 'system',
                    'browser' => 'system',
                    'os' => 'system',
                    'is_unique' => false,
                    'view_duration' => 0,
                    'notes' => json_encode([
                        'action' => 'payment_reset',
                        'reset_date' => now()->format('Y-m-d H:i:s'),
                        'timezone' => now()->timezone->getName(),
                        'payment_amount' => $paymentAmount,
                        'previous_state' => $previousState,
                        'reason' => 'payment_processed'
                    ])
                ]);

                // Força a sincronização dos registros
                $this->syncBillingRecordsWithRetry($userId);

                return true;
            });

        } catch (\Exception $e) {
            Log::error('Erro ao resetar visualizações extras', [
                'user_id' => $userId,
                'payment_amount' => $paymentAmount,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        } finally {
            if (isset($lock)) {
                $lock->release();
            }
        }
    }

    /**
     * Limpa todos os caches relacionados ao usuário
     * @param int $userId
     */
    private function clearUserCaches($userId)
    {
        $currentMonth = now()->format('Ym');
        $nextMonth = now()->addMonth()->format('Ym');
        $previousMonth = now()->subMonth()->format('Ym');

        $cacheKeys = [
            "views_count_{$userId}_{$currentMonth}",
            "views_count_{$userId}_{$nextMonth}",
            "views_count_{$userId}_{$previousMonth}",
            "billing_control_{$userId}",
            "user_views_{$userId}",
            "billing_status_{$userId}"
        ];

        foreach ($cacheKeys as $key) {
            Cache::forget($key);
        }
        
        // Limpa também cache por tags se disponível
        try {
            Cache::tags(["user_{$userId}"])->flush();
        } catch (\Exception $e) {
            // Ignora erro se cache driver não suporta tags
        }
    }

    /**
     * Sincroniza registros de cobrança com retry
     * @param int $userId
     * @return bool
     */
    private function syncBillingRecordsWithRetry($userId)
    {
        $attempts = 0;
        $maxAttempts = 3;
        $success = false;

        while ($attempts < $maxAttempts && !$success) {
            try {
                $this->syncBillingRecords($userId);
                $success = true;
            } catch (\Exception $e) {
                $attempts++;
                Log::warning("Tentativa {$attempts} de sincronização falhou", [
                    'user_id' => $userId,
                    'error' => $e->getMessage()
                ]);
                if ($attempts < $maxAttempts) {
                    sleep(1); // Pequeno delay entre tentativas
                }
            }
        }

        if (!$success) {
            Log::error("Todas as tentativas de sincronização falharam", [
                'user_id' => $userId
            ]);
        }

        return $success;
    }

    /**
     * Sincroniza os registros de cobrança
     */
    public function syncBillingRecords($userId)
    {
        try {
            DB::beginTransaction();

            // Obtém o total de visualizações atual
            $totalViews = $this->getTotalViews($userId);
            $planViewsLimit = $this->getUserPlanViewsLimit($userId);
            $extraViews = max(0, $totalViews - $planViewsLimit);

            // Remove registros pendentes existentes
            ViewBillingRecord::where('user_id', $userId)
                ->where('billing_period_start', '<=', now())
                ->where('billing_period_end', '>=', now())
                ->where('status', 'pending')
                ->delete();

            // Se houver visualizações extras, cria um novo registro
            if ($extraViews > 0) {
                $extraViewsCost = $extraViews * self::EXTRA_VIEW_COST;
                
                ViewBillingRecord::create([
                    'user_id' => $userId,
                    'billing_period_start' => now()->startOfMonth(),
                    'billing_period_end' => now()->endOfMonth(),
                    'total_views' => $totalViews,
                    'extra_views' => $extraViews,
                    'extra_views_cost' => $extraViewsCost,
                    'status' => 'pending',
                    'notes' => json_encode([
                        'charge_type' => 'sync',
                        'sync_date' => now()->format('Y-m-d H:i:s')
                    ])
                ]);

                // Atualiza o valor pendente no controle de billing
                UserBillingControl::where('user_id', $userId)->update([
                    'pending_amount' => $extraViewsCost
                ]);
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao sincronizar registros de cobrança: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Reseta as contagens de visualização após upgrade do plano
     */
    public function resetViewCountsAfterUpgrade(int $userId): void
    {
        try {
            DB::beginTransaction();

            // 1. Obter assinatura anterior e atual
            $subscription = Subscription::where('user_id', $userId)
                ->with('paypalPlan')
                ->first();

            // 2. Arquivar visualizações do plano atual
            $currentViews = $this->getCurrentViews($userId);
            $oldPlanLimit = $subscription->paypalPlan ? $subscription->paypalPlan->views_limit : self::BASIC_PLAN_VIEWS;
            $extraViews = max(0, $currentViews - $oldPlanLimit);

            // Criar registro de billing para visualizações extras (se houver)
            if ($extraViews > 0) {
                ViewBillingRecord::create([
                    'user_id' => $userId,
                    'extra_views' => $extraViews,
                    'amount' => $extraViews * self::EXTRA_VIEW_COST,
                    'status' => 'processed',
                    'description' => 'Extra views before plan upgrade',
                    'processed_at' => now()
                ]);
            }

            // Criar registro de visualizações padrão do plano
            ViewBillingRecord::create([
                'user_id' => $userId,
                'extra_views' => min($currentViews, $oldPlanLimit),
                'amount' => 0, // Visualizações padrão não são cobradas
                'status' => 'processed',
                'description' => 'Standard views before plan upgrade',
                'processed_at' => now()
            ]);

            // 3. Arquivar estatísticas antigas
            ViewStatistic::where('user_id', $userId)
                ->whereNull('archived_at')
                ->update([
                    'archived_at' => now(),
                    'archived_reason' => 'Plan upgrade'
                ]);

            // 4. Criar registro de reset para o novo plano
            ViewStatistic::create([
                'user_id' => $userId,
                'template_id' => 0, // ID especial para registros de sistema
                'viewer_ip' => request()->ip(),
                'viewer_session' => 'reset_upgrade_' . time(),
                'device_type' => 'system',
                'browser' => 'system',
                'os' => 'system',
                'is_unique' => false,
                'view_duration' => 0,
                'notes' => json_encode([
                    'action' => 'plan_upgrade_reset',
                    'reset_date' => now()->format('Y-m-d H:i:s'),
                    'old_plan' => $oldPlanLimit,
                    'new_plan' => $subscription->paypalPlan->views_limit,
                    'old_views' => $currentViews,
                    'reason' => 'Plan upgrade'
                ])
            ]);

            // 5. Limpar cache
            $this->clearViewsCache($userId);

            // 6. Resetar o controle de billing
            UserBillingControl::where('user_id', $userId)->update([
                'pending_amount' => 0,
                'is_blocked' => false,
                'block_reason' => null,
                'last_billing_check' => now()
            ]);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error resetting view counts after upgrade:', [
                'error' => $e->getMessage(),
                'user_id' => $userId
            ]);
        }
    }

    /**
     * Limpa o cache de visualizações de um usuário
     */
    public function clearViewsCache(int $userId): void
    {
        $cacheKey = "views_count_{$userId}_" . date('Ym');
        Cache::forget($cacheKey);
        Cache::forget("user_plan_views_limit_{$userId}");
    }

    protected function processAutomaticCharge($userId)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($userId);
            $pendingCharges = ViewBillingRecord::where('user_id', $userId)
                ->where('status', 'pending')
                ->get();

            if ($pendingCharges->isEmpty()) {
                DB::commit();
                return true;
            }

            $totalAmount = $pendingCharges->sum('extra_views_cost');

            try {
                // Tenta realizar a cobrança no cartão
                $charge = \Stripe\Charge::create([
                    'amount' => $totalAmount * 100, // Stripe trabalha com centavos
                    'currency' => 'brl',
                    'customer' => $user->stripe_customer_id,
                    'description' => 'Cobrança de visualizações extras',
                    'metadata' => [
                        'user_id' => $userId,
                        'extra_views' => $pendingCharges->sum('extra_views'),
                        'billing_period' => now()->format('Y-m')
                    ]
                ]);

                if ($charge->status === 'succeeded') {
                    // Atualiza registros como pagos
                    foreach ($pendingCharges as $pendingCharge) {
                        $pendingCharge->status = 'paid';
                        $pendingCharge->paid_at = Carbon::now();
                        $pendingCharge->payment_id = $charge->id;
                        $pendingCharge->save();
                    }

                    // Atualiza controle de billing
                    $billingControl = UserBillingControl::where('user_id', $userId)->first();
                    if ($billingControl) {
                        $billingControl->pending_amount -= $totalAmount;
                        if ($billingControl->pending_amount < 0) {
                            $billingControl->pending_amount = 0;
                        }
                        $billingControl->is_blocked = false;
                        $billingControl->block_reason = null;
                        $billingControl->save();
                    }

                    DB::commit();
                    return true;
                }
            } catch (\Stripe\Exception\CardException $e) {
                // Falha no cartão
                $billingControl = UserBillingControl::where('user_id', $userId)->first();
                if ($billingControl && $totalAmount >= self::MAX_PENDING_AMOUNT) {
                    $billingControl->is_blocked = true;
                    $billingControl->block_reason = 'Falha no pagamento: ' . $e->getMessage();
                    $billingControl->save();
                }

                DB::commit();
                return false;
            }

            DB::rollBack();
            return false;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao processar cobrança automática: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Tenta processar cobrança quando atinge R$50
     */
    protected function tryProcessChargeOnThreshold($userId, $pendingAmount)
    {
        if ($pendingAmount >= self::AUTO_CHARGE_THRESHOLD) {
            return $this->processAutomaticCharge($userId);
        }
        return true;
    }
}
