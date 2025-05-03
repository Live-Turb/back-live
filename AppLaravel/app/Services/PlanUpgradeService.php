<?php

namespace App\Services;

use App\Models\Subscription;
use App\Models\ViewStatistic;
use App\Models\ViewBillingRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlanUpgradeService
{
    protected $viewTrackingService;

    public function __construct(ViewTrackingService $viewTrackingService)
    {
        $this->viewTrackingService = $viewTrackingService;
    }

    /**
     * Processa o upgrade do plano, arquivando visualizações antigas e resetando contadores
     */
    public function handlePlanUpgrade(int $userId, string $oldPlanName, string $newPlanName): bool
    {
        try {
            DB::beginTransaction();

            // 1. Arquivar visualizações do plano atual
            $currentViews = $this->viewTrackingService->getCurrentViews($userId);
            $oldPlanLimit = $this->getPlanLimit($oldPlanName);
            $extraViews = max(0, $currentViews - $oldPlanLimit);

            // Criar registro de billing para visualizações extras (se houver)
            if ($extraViews > 0) {
                ViewBillingRecord::create([
                    'user_id' => $userId,
                    'extra_views' => $extraViews,
                    'amount' => $extraViews * ViewTrackingService::EXTRA_VIEW_COST,
                    'status' => 'processed',
                    'description' => "Extra views from {$oldPlanName} plan before upgrade to {$newPlanName}",
                    'processed_at' => now()
                ]);
            }

            // Criar registro de visualizações padrão do plano
            ViewBillingRecord::create([
                'user_id' => $userId,
                'extra_views' => min($currentViews, $oldPlanLimit),
                'amount' => 0, // Visualizações padrão não são cobradas
                'status' => 'processed',
                'description' => "Standard views from {$oldPlanName} plan before upgrade to {$newPlanName}",
                'processed_at' => now()
            ]);

            // 2. Arquivar estatísticas antigas
            ViewStatistic::where('user_id', $userId)
                ->whereNull('archived_at')
                ->update([
                    'archived_at' => now(),
                    'archived_reason' => "Plan upgrade from {$oldPlanName} to {$newPlanName}"
                ]);

            // 3. Limpar cache de visualizações
            $this->viewTrackingService->clearViewsCache($userId);

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error processing plan upgrade:', [
                'error' => $e->getMessage(),
                'user_id' => $userId,
                'old_plan' => $oldPlanName,
                'new_plan' => $newPlanName
            ]);
            return false;
        }
    }

    /**
     * Retorna o limite de visualizações para um plano específico
     */
    protected function getPlanLimit(string $planName): int
    {
        return match (strtolower($planName)) {
            'basic' => ViewTrackingService::BASIC_PLAN_VIEWS,
            'standard' => ViewTrackingService::STANDARD_PLAN_VIEWS,
            'premium' => ViewTrackingService::PREMIUM_PLAN_VIEWS,
            default => ViewTrackingService::BASIC_PLAN_VIEWS,
        };
    }
}
