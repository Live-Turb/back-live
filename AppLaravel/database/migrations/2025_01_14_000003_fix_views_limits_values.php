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
        // Primeiro, garantir que o campo existe
        if (!Schema::hasColumn('pay_pal_plans', 'views_limit')) {
            Schema::table('pay_pal_plans', function (Blueprint $table) {
                $table->integer('views_limit')->default(0)->after('limit');
            });
        }

        // Atualizar os limites de visualização para cada plano
        DB::table('pay_pal_plans')
            ->where('name', 'Basic')
            ->update(['views_limit' => 6000]);

        DB::table('pay_pal_plans')
            ->where('name', 'Smart')
            ->update(['views_limit' => 25000]);

        DB::table('pay_pal_plans')
            ->where('name', 'Gold')
            ->update(['views_limit' => 50000]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('pay_pal_plans')->update(['views_limit' => 0]);
    }
};
