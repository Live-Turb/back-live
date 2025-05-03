<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ViewStatistic;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;

class SimulateViewsLimit extends Command
{
    protected $signature = 'views:simulate-limit {email?}';
    protected $description = 'Simula um número específico de visualizações para um usuário';

    public function handle()
    {
        // Se o email foi fornecido, busca o usuário pelo email
        if ($email = $this->argument('email')) {
            $user = User::where('email', $email)->first();
            if (!$user) {
                $this->error("Usuário com email {$email} não encontrado!");
                return 1;
            }
            $userId = $user->id;
        } else {
            // Se não foi fornecido email, pede para o usuário digitar
            $email = $this->ask('Digite o email do usuário:');
            $user = User::where('email', $email)->first();
            if (!$user) {
                $this->error("Usuário com email {$email} não encontrado!");
                return 1;
            }
            $userId = $user->id;
        }

        // Busca a assinatura do usuário
        $subscription = Subscription::where('user_id', $userId)
            ->where('status', 'ACTIVE')
            ->whereDate('expire_date', '>', now())
            ->with('paypalPlan')
            ->first();

        if (!$subscription || !$subscription->paypalPlan) {
            $this->error("Usuário {$email} não tem uma assinatura ativa!");
            return 1;
        }

        $viewsLimit = $subscription->paypalPlan->views_limit;
        
        // Conta visualizações atuais
        $currentViews = ViewStatistic::where('user_id', $userId)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $this->info("\nStatus atual do usuário {$email}:");
        $this->info("ID: {$userId}");
        $this->info("Plano: {$subscription->paypalPlan->name}");
        $this->info("Limite de visualizações: " . number_format($viewsLimit));
        $this->info("Visualizações atuais: " . number_format($currentViews));
        $this->info("Visualizações restantes: " . number_format($viewsLimit - $currentViews));

        // Calcula quantas visualizações precisamos adicionar (deixando 1 restante)
        $targetViews = $viewsLimit - 1; // 5999 para plano Basic
        $viewsToAdd = $targetViews - $currentViews;

        if ($viewsToAdd <= 0) {
            $this->info("\nO usuário já ultrapassou o limite de visualizações.");
            $this->table(
                ['Limite do Plano', 'Visualizações Atuais', 'Restantes'],
                [[
                    number_format($viewsLimit),
                    number_format($currentViews),
                    number_format($viewsLimit - $currentViews)
                ]]
            );
            return 0;
        }

        if (!$this->confirm("Deseja adicionar {$viewsToAdd} visualizações para deixar apenas 1 restante?")) {
            $this->info('Operação cancelada.');
            return 0;
        }

        $this->info("\nAdicionando {$viewsToAdd} visualizações...");
        $bar = $this->output->createProgressBar($viewsToAdd);
        $bar->start();

        // Adiciona as visualizações em lotes para melhor performance
        $batchSize = 1000;
        $batches = ceil($viewsToAdd / $batchSize);

        for ($batch = 0; $batch < $batches; $batch++) {
            $records = [];
            $currentBatchSize = min($batchSize, $viewsToAdd - ($batch * $batchSize));

            for ($i = 0; $i < $currentBatchSize; $i++) {
                $records[] = [
                    'user_id' => $userId,
                    'viewer_ip' => '127.0.0.1',
                    'viewer_session' => 'simulation_' . uniqid(),
                    'device_type' => 'desktop',
                    'browser' => 'Chrome',
                    'os' => 'Windows',
                    'is_unique' => true,
                    'country' => 'BR',
                    'city' => 'São Paulo',
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            ViewStatistic::insert($records);
            $bar->advance($currentBatchSize);
        }

        $bar->finish();
        $this->newLine();
        $this->info("\nAdicionadas {$viewsToAdd} visualizações. Agora falta 1 visualização para atingir o limite.");

        // Mostra o status final
        $finalViews = ViewStatistic::where('user_id', $userId)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $this->table(
            ['Limite do Plano', 'Visualizações Atuais', 'Restantes'],
            [[
                number_format($viewsLimit),
                number_format($finalViews),
                number_format($viewsLimit - $finalViews)
            ]]
        );

        return 0;
    }
}
