<?php

namespace App\Services;

use App\Models\User;
use App\Models\ViewBillingRecord;
use App\Notifications\ViewsLimitWarning;
use App\Notifications\PaymentPendingReminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    protected $viewTrackingService;

    public function __construct(ViewTrackingService $viewTrackingService)
    {
        $this->viewTrackingService = $viewTrackingService;
    }

    /**
     * Verifica e envia notificações de limite de visualizações
     */
    public function checkViewsLimits()
    {
        try {
            // Busca usuários com assinatura ativa
            $users = User::whereHas('subscription', function ($query) {
                $query->where('status', 'ACTIVE')
                    ->whereDate('expire_date', '>', now());
            })->get();

            foreach ($users as $user) {
                $viewsInfo = $this->viewTrackingService->checkViewsLimit($user->id);
                
                // Se usou mais de 80% do limite
                if ($viewsInfo['has_subscription'] && 
                    ($viewsInfo['current'] / $viewsInfo['limit']) >= 0.8) {
                    
                    // Verifica se já notificou nas últimas 24 horas
                    $recentNotification = $user->notifications()
                        ->where('type', ViewsLimitWarning::class)
                        ->where('created_at', '>=', now()->subDay())
                        ->exists();

                    if (!$recentNotification) {
                        $user->notify(new ViewsLimitWarning(
                            $viewsInfo['current'],
                            $viewsInfo['limit'],
                            $viewsInfo['remaining']
                        ));

                        Log::info('Notificação de limite enviada:', [
                            'user_id' => $user->id,
                            'current_views' => $viewsInfo['current'],
                            'limit' => $viewsInfo['limit']
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Erro ao verificar limites de visualização:', [
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Verifica e envia lembretes de pagamentos pendentes
     */
    public function checkPendingPayments()
    {
        try {
            // Busca registros pendentes
            $pendingRecords = ViewBillingRecord::where('status', 'pending')
                ->where('created_at', '<=', now()->subDays(3))
                ->get();

            foreach ($pendingRecords as $record) {
                $daysPending = $record->created_at->diffInDays(now());
                
                // Verifica se já enviou lembrete nas últimas 24 horas
                $recentReminder = $record->user->notifications()
                    ->where('type', PaymentPendingReminder::class)
                    ->where('data->billing_record_id', $record->id)
                    ->where('created_at', '>=', now()->subDay())
                    ->exists();

                if (!$recentReminder) {
                    $record->user->notify(new PaymentPendingReminder($record, $daysPending));

                    Log::info('Lembrete de pagamento enviado:', [
                        'user_id' => $record->user_id,
                        'record_id' => $record->id,
                        'days_pending' => $daysPending
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Erro ao verificar pagamentos pendentes:', [
                'error' => $e->getMessage()
            ]);
        }
    }
}
