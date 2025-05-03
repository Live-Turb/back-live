<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\ViewBillingRecord;
use App\Models\UserBillingControl;
use App\Services\ViewTrackingService;

class TestBilling extends Command
{
    protected $signature = 'billing:test {email} {views=6500}';
    protected $description = 'Test billing system with a specific number of views';

    public function handle()
    {
        try {
            $email = $this->argument('email');
            $views = $this->argument('views');

            $this->info("Iniciando teste de billing para {$email} com {$views} visualizações");

            $user = User::where('email', $email)->firstOrFail();
            
            // Cria controle de billing se não existir
            $billingControl = UserBillingControl::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'pending_amount' => 0,
                    'is_blocked' => false,
                    'last_ip' => '127.0.0.1',
                    'device_fingerprint' => md5('test')
                ]
            );

            // Calcula visualizações extras
            $extraViews = max(0, $views - 6000);
            $chargesNeeded = floor($extraViews / 500);

            $this->info("Usuário encontrado: {$user->name}");
            $this->info("Visualizações extras: {$extraViews}");
            $this->info("Cobranças necessárias: {$chargesNeeded}");

            // Cria cobranças
            for ($i = 0; $i < $chargesNeeded; $i++) {
                ViewBillingRecord::create([
                    'user_id' => $user->id,
                    'extra_views' => 500,
                    'extra_views_cost' => 10.00,
                    'status' => 'pending'
                ]);

                $billingControl->pending_amount += 10.00;
            }

            // Atualiza controle
            if ($billingControl->pending_amount >= 100.00) {
                $billingControl->is_blocked = true;
                $billingControl->block_reason = 'Limite máximo de cobranças pendentes atingido (R$ 100,00). Por favor, regularize seu pagamento.';
                $this->warn("Usuário bloqueado por atingir limite de R$ 100,00");
            } elseif ($billingControl->pending_amount >= 50.00) {
                // Tenta cobrança automática
                $service = new ViewTrackingService();
                $chargeResult = $service->processAutomaticCharge($user->id);
                
                if (!$chargeResult) {
                    $this->warn("Cobrança automática falhou");
                } else {
                    $this->info("Cobrança automática realizada com sucesso");
                }
            }

            $billingControl->save();

            // Busca estado atual
            $pendingCharges = ViewBillingRecord::where('user_id', $user->id)
                ->where('status', 'pending')
                ->get();

            $this->info("\nEstado atual do billing:");
            $this->table(
                ['ID', 'Views Extras', 'Custo', 'Status', 'Criado em'],
                $pendingCharges->map(function($charge) {
                    return [
                        $charge->id,
                        $charge->extra_views,
                        'R$ ' . number_format($charge->extra_views_cost, 2, ',', '.'),
                        $charge->status,
                        $charge->created_at
                    ];
                })
            );

            $this->info("\nControle de Billing:");
            $this->table(
                ['Valor Pendente', 'Bloqueado', 'Motivo'],
                [[
                    'R$ ' . number_format($billingControl->pending_amount, 2, ',', '.'),
                    $billingControl->is_blocked ? 'Sim' : 'Não',
                    $billingControl->block_reason ?? 'N/A'
                ]]
            );

        } catch (\Exception $e) {
            $this->error("Erro ao testar billing: " . $e->getMessage());
            $this->error($e->getTraceAsString());
        }
    }
}
