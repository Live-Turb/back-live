<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // Verifica se o plano Gold já existe
        $goldPlan = DB::table('pay_pal_plans')->where('name', 'Gold')->first();

        if (!$goldPlan) {
            // Insere o plano Gold
            DB::table('pay_pal_plans')->insert([
                'name' => 'Gold',
                'uuid' => (string) Str::uuid(),
                'plan_key' => 'GOLD_PLAN',
                'price' => 297.00,
                'comment_limit' => 100,
                'step' => 1,
                'limit' => 1,
                'duration' => 30, // 30 dias
                'views_limit' => 50000,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Atualiza a assinatura do usuário para Gold
        $goldPlanId = DB::table('pay_pal_plans')->where('name', 'Gold')->value('id');

        if ($goldPlanId) {
            DB::table('subscriptions')
                ->where('user_id', function($query) {
                    $query->select('id')
                        ->from('users')
                        ->where('email', 'antoniojhuliene@gmail.com')
                        ->limit(1);
                })
                ->where('status', 'ACTIVE')
                ->update([
                    'plan_id' => $goldPlanId
                ]);
        }
    }

    public function down(): void
    {
        // Remove o plano Gold se necessário
        DB::table('pay_pal_plans')->where('name', 'Gold')->delete();
    }
};
