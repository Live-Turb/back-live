<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Primeiro, verificar se existem os planos
        $plans = DB::table('pay_pal_plans')->pluck('name')->toArray();
        
        // Atualizar Basic
        DB::table('pay_pal_plans')
            ->where('name', 'Basic')
            ->update([
                'views_limit' => 6000
            ]);

        // Atualizar Smart
        DB::table('pay_pal_plans')
            ->where('name', 'Smart')
            ->update([
                'views_limit' => 25000
            ]);

        // Atualizar Gold
        DB::table('pay_pal_plans')
            ->where('name', 'Gold')
            ->update([
                'views_limit' => 50000
            ]);

        // Log dos planos atualizados
        DB::table('pay_pal_plans')
            ->whereIn('name', ['Basic', 'Smart', 'Gold'])
            ->orderBy('name')
            ->get()
            ->each(function ($plan) {
                info("Plano {$plan->name} atualizado com views_limit = {$plan->views_limit}");
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Não vamos reverter as alterações de limite
    }
};
