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
        // Atualizar os limites de visualização para cada plano usando SQL direto
        DB::statement("
            UPDATE pay_pal_plans 
            SET views_limit = CASE 
                WHEN name = 'Basic' THEN 6000
                WHEN name = 'Smart' THEN 25000
                WHEN name = 'Gold' THEN 50000
                ELSE views_limit
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("UPDATE pay_pal_plans SET views_limit = 0");
    }
};
