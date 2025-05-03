<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('check:user {email}', function ($email) {
    $user = DB::table('users')->where('email', $email)->first();
    
    if (!$user) {
        $this->error("Usuário não encontrado com o email: {$email}");
        return;
    }

    $this->info("Usuário encontrado:");
    $this->table(['ID', 'Nome', 'Email'], [[$user->id, $user->name, $user->email]]);

    $pendingCharges = DB::table('view_billing_records')
        ->where('user_id', $user->id)
        ->where('status', 'pending')
        ->get();

    if ($pendingCharges->isEmpty()) {
        $this->info("Não há cobranças pendentes para este usuário.");
    } else {
        $this->info("\nCobranças pendentes:");
        $charges = $pendingCharges->map(function($charge) {
            return [
                $charge->id,
                $charge->extra_views_cost,
                $charge->created_at
            ];
        })->toArray();
        
        $this->table(['ID', 'Valor', 'Data'], $charges);
    }

    $billingControl = DB::table('user_billing_controls')
        ->where('user_id', $user->id)
        ->first();

    if ($billingControl) {
        $this->info("\nStatus de bloqueio:");
        $this->table(
            ['Bloqueado', 'Valor Pendente', 'Motivo'],
            [[
                $billingControl->is_blocked ? 'Sim' : 'Não',
                $billingControl->pending_amount,
                $billingControl->block_reason ?? 'N/A'
            ]]
        );
    }
})->purpose('Verifica usuário e suas cobranças pendentes');

Artisan::command('check:template {uuid}', function ($uuid) {
    // Verifica o template
    $template = DB::table('video_details')
        ->where('uuid', $uuid)
        ->first();
    
    if (!$template) {
        $this->error("Template não encontrado com UUID: {$uuid}");
        return;
    }

    $this->info("Template encontrado:");
    $this->table(['ID', 'UUID', 'User ID', 'Created At'], [
        [$template->id, $template->uuid, $template->user_id, $template->created_at]
    ]);

    // Verifica visualizações do mês atual
    $currentMonth = now()->format('Y-m');
    $views = DB::table('view_statistics')
        ->where('user_id', $template->user_id)
        ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$currentMonth])
        ->count();

    $this->info("\nVisualizações do mês atual ({$currentMonth}): {$views}");

    // Verifica limites do usuário
    $user = DB::table('users')
        ->select('id', 'name', 'email', 'views_limit', 'extra_views')
        ->where('id', $template->user_id)
        ->first();

    if ($user) {
        $this->info("\nInformações do usuário:");
        $this->table(
            ['Nome', 'Email', 'Limite de Views', 'Views Extras'],
            [[$user->name, $user->email, $user->views_limit, $user->extra_views]]
        );

        // Calcula views disponíveis
        $totalLimit = $user->views_limit + $user->extra_views;
        $viewsLeft = $totalLimit - $views;

        $this->info("\nStatus das visualizações:");
        $this->table(
            ['Total Permitido', 'Usadas', 'Disponíveis'],
            [[$totalLimit, $views, $viewsLeft]]
        );
    }
})->purpose('Verifica status de um template específico');

Artisan::command('check:views-detailed {uuid}', function ($uuid) {
    $template = DB::table('video_details')
        ->where('uuid', $uuid)
        ->first();
    
    if (!$template) {
        $this->error("Template não encontrado com UUID: {$uuid}");
        return;
    }

    $userId = $template->user_id;
    $currentMonth = now()->format('Y-m');
    
    // Contagem de visualizações do mês atual
    $views = DB::table('view_statistics')
        ->where('user_id', $userId)
        ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$currentMonth])
        ->count();

    // Informações do usuário
    $user = DB::table('users')->find($userId);
    
    // Status de bloqueio
    $billingControl = DB::table('user_billing_controls')
        ->where('user_id', $userId)
        ->first();

    $this->info("\n=== Status do Template ===");
    $this->table(['UUID', 'User ID', 'Created At'], [
        [$template->uuid, $template->user_id, $template->created_at]
    ]);

    $this->info("\n=== Visualizações do Mês Atual ===");
    $this->table(
        ['Mês', 'Total Views', 'Limite Básico', 'Views Extras'],
        [[$currentMonth, $views, 6000, max(0, $views - 6000)]]
    );

    if ($billingControl) {
        $this->info("\n=== Status de Bloqueio ===");
        $this->table(
            ['Bloqueado', 'Valor Pendente', 'Motivo'],
            [[
                $billingControl->is_blocked ? 'Sim' : 'Não',
                $billingControl->pending_amount ?? '0.00',
                $billingControl->block_reason ?? 'N/A'
            ]]
        );
    }

    // Calcula valores
    $extraViews = max(0, $views - 6000);
    $pendingAmount = $extraViews * 0.02; // R$0.02 por view extra

    $this->info("\n=== Análise Financeira ===");
    $this->table(
        ['Views Extras', 'Custo por View', 'Valor Total Pendente'],
        [[$extraViews, 'R$ 0.02', 'R$ ' . number_format($pendingAmount, 2)]]
    );

})->purpose('Verifica status detalhado das visualizações de um template');

Artisan::command('check:unpaid-views {userId}', function ($userId) {
    // Total de visualizações do mês
    $currentViews = DB::table('view_statistics')
        ->where('user_id', $userId)
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();

    // Visualizações já processadas/pagas
    $processedViews = DB::table('view_billing_records')
        ->where('user_id', $userId)
        ->where('status', 'processed')
        ->where('billing_period_start', '<=', now())
        ->where('billing_period_end', '>=', now())
        ->sum('extra_views');

    // Cálculos
    $basicLimit = 6000;
    $extraViews = max(0, $currentViews - $basicLimit);
    $unpaidViews = max(0, $extraViews - $processedViews);
    $pendingAmount = $unpaidViews * 0.02;

    $this->info("\n=== Status das Visualizações ===");
    $this->table(
        ['Total Views', 'Limite Básico', 'Views Extras', 'Views Processadas', 'Views Não Pagas', 'Valor Pendente'],
        [[
            $currentViews,
            $basicLimit,
            $extraViews,
            $processedViews,
            $unpaidViews,
            'R$ ' . number_format($pendingAmount, 2)
        ]]
    );

})->purpose('Verifica visualizações não pagas do usuário');

Artisan::command('reset:extra-views {userId} {amount}', function ($userId, $amount) {
    try {
        DB::beginTransaction();

        $viewTrackingService = app(App\Services\ViewTrackingService::class);
        
        // Registra o pagamento
        $result = $viewTrackingService->resetExtraViews($userId, $amount);
        
        if ($result) {
            DB::commit();
            $this->info("Visualizações extras resetadas com sucesso!");
            
            // Verifica o novo status
            $billingControl = DB::table('user_billing_controls')
                ->where('user_id', $userId)
                ->first();

            $this->info("\nNovo status de bloqueio:");
            $this->table(
                ['Bloqueado', 'Valor Pendente', 'Motivo'],
                [[
                    $billingControl->is_blocked ? 'Sim' : 'Não',
                    $billingControl->pending_amount ?? '0.00',
                    $billingControl->block_reason ?? 'N/A'
                ]]
            );

            // Mostra visualizações atuais
            $currentViews = DB::table('view_statistics')
                ->where('user_id', $userId)
                ->whereMonth('created_at', now()->month)
                ->count();

            $this->info("\nVisualizações do mês atual: " . $currentViews);
        } else {
            DB::rollBack();
            $this->error("Não foi possível resetar as visualizações extras.");
        }
    } catch (\Exception $e) {
        DB::rollBack();
        $this->error("Erro ao resetar visualizações: " . $e->getMessage());
    }
})->purpose('Reseta visualizações extras após pagamento');

Artisan::command('force:reset-views {userId}', function ($userId) {
    try {
        DB::beginTransaction();

        // 1. Atualiza o billing control
        DB::table('user_billing_controls')
            ->where('user_id', $userId)
            ->update([
                'is_blocked' => false,
                'pending_amount' => 0,
                'block_reason' => null,
                'updated_at' => now()
            ]);

        // 2. Marca todas as cobranças pendentes como pagas
        DB::table('view_billing_records')
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->update([
                'status' => 'paid',
                'payment_date' => now(),
                'updated_at' => now()
            ]);

        // 3. Limpa os caches relacionados
        $cacheKeys = [
            "billing_control_{$userId}",
            "views_count_{$userId}_" . date('Ym'),
            "user_billing_status_{$userId}"
        ];

        foreach ($cacheKeys as $key) {
            Cache::forget($key);
        }

        DB::commit();
        $this->info("Reset forçado realizado com sucesso!");

        // 4. Verifica o novo status
        $billingControl = DB::table('user_billing_controls')
            ->where('user_id', $userId)
            ->first();

        $this->info("\nNovo status de bloqueio:");
        $this->table(
            ['Bloqueado', 'Valor Pendente', 'Motivo'],
            [[
                $billingControl->is_blocked ? 'Sim' : 'Não',
                $billingControl->pending_amount ?? '0.00',
                $billingControl->block_reason ?? 'N/A'
            ]]
        );

        // 5. Mostra visualizações atuais
        $currentViews = DB::table('view_statistics')
            ->where('user_id', $userId)
            ->whereMonth('created_at', now()->month)
            ->count();

        $this->info("\nVisualizações do mês atual: " . $currentViews);

    } catch (\Exception $e) {
        DB::rollBack();
        $this->error("Erro ao forçar reset: " . $e->getMessage());
    }
})->purpose('Força o reset das visualizações e remove bloqueios');

Artisan::command('create:billing-records {userId}', function ($userId) {
    try {
        DB::beginTransaction();

        // Remove registros antigos
        DB::table('view_billing_records')
            ->where('user_id', $userId)
            ->delete();

        // Cria primeiro bloco como processado
        DB::table('view_billing_records')->insert([
            'user_id' => $userId,
            'billing_period_start' => now()->startOfMonth(),
            'billing_period_end' => now()->endOfMonth(),
            'total_views' => 2500,
            'extra_views' => 2500,
            'extra_views_cost' => 50.00,
            'status' => 'processed',
            'notes' => json_encode([
                'charge_type' => 'auto_block',
                'block_size' => 2500,
                'block_number' => 1
            ]),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Cria segundo bloco como pendente
        DB::table('view_billing_records')->insert([
            'user_id' => $userId,
            'billing_period_start' => now()->startOfMonth(),
            'billing_period_end' => now()->endOfMonth(),
            'total_views' => 2500,
            'extra_views' => 2500,
            'extra_views_cost' => 50.00,
            'status' => 'pending',
            'notes' => json_encode([
                'charge_type' => 'auto_block',
                'block_size' => 2500,
                'block_number' => 2
            ]),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Atualiza o controle de billing
        DB::table('user_billing_controls')
            ->where('user_id', $userId)
            ->update([
                'is_blocked' => false,
                'pending_amount' => 50.00,
                'block_reason' => null,
                'updated_at' => now()
            ]);

        DB::commit();
        $this->info('Registros de cobrança criados com sucesso!');
    } catch (\Exception $e) {
        DB::rollBack();
        $this->error('Erro ao criar registros: ' . $e->getMessage());
    }
})->purpose('Cria registros de cobrança para teste');
