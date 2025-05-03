<?php

namespace App\Services;

use App\Models\ViewBillingRecord;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ViewBillingService
{
    /**
     * Processa as cobranças extras pendentes
     */
    public function processExtraViewsCharges()
    {
        $pendingCharges = ViewBillingRecord::where('status', 'pending')->get();

        foreach ($pendingCharges as $charge) {
            try {
                $user = User::find($charge->user_id);
                
                // Prepara os dados para a cobrança
                $chargeData = [
                    'amount' => $charge->extra_views_cost * 100, // Converte para centavos
                    'description' => sprintf(
                        'Cobrança extra por %d visualizações excedentes no período de %s a %s',
                        $charge->extra_views,
                        $charge->billing_period_start->format('d/m/Y'),
                        $charge->billing_period_end->format('d/m/Y')
                    ),
                    'customer_id' => $user->stripe_id
                ];

                // Processa a cobrança no Stripe
                $stripeCharge = \Stripe\Charge::create([
                    'amount' => $chargeData['amount'],
                    'currency' => 'brl',
                    'customer' => $chargeData['customer_id'],
                    'description' => $chargeData['description'],
                    'metadata' => [
                        'billing_record_id' => $charge->id,
                        'extra_views' => $charge->extra_views,
                        'period_start' => $charge->billing_period_start->format('Y-m-d'),
                        'period_end' => $charge->billing_period_end->format('Y-m-d')
                    ]
                ]);

                // Atualiza o registro de cobrança
                $charge->update([
                    'status' => 'processed',
                    'notes' => json_encode([
                        'stripe_charge_id' => $stripeCharge->id,
                        'processed_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ])
                ]);

                // Notifica o usuário
                $user->notify(new ExtraViewsChargeProcessed($charge));

            } catch (\Exception $e) {
                Log::error('Erro ao processar cobrança extra:', [
                    'charge_id' => $charge->id,
                    'error' => $e->getMessage()
                ]);

                $charge->update([
                    'status' => 'failed',
                    'notes' => json_encode([
                        'error' => $e->getMessage(),
                        'failed_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ])
                ]);

                // Notifica o usuário sobre a falha
                $user->notify(new ExtraViewsChargeFailed($charge));
            }
        }
    }

    /**
     * Gera um relatório de cobranças do período
     */
    public function generateBillingReport($userId, $startDate = null, $endDate = null)
    {
        $startDate = $startDate ?? Carbon::now()->startOfMonth();
        $endDate = $endDate ?? Carbon::now()->endOfMonth();

        return ViewBillingRecord::where('user_id', $userId)
            ->whereBetween('billing_period_start', [$startDate, $endDate])
            ->get()
            ->map(function ($record) {
                return [
                    'period' => sprintf(
                        '%s a %s',
                        $record->billing_period_start->format('d/m/Y'),
                        $record->billing_period_end->format('d/m/Y')
                    ),
                    'total_views' => $record->total_views,
                    'extra_views' => $record->extra_views,
                    'cost' => $record->extra_views_cost,
                    'status' => $record->status,
                    'processed_at' => $record->updated_at->format('d/m/Y H:i:s')
                ];
            });
    }
}
