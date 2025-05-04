<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Verificar se a tabela existe
        if (Schema::hasTable('pay_pal_plans')) {
            // Verificar se a coluna já existe
            if (!Schema::hasColumn('pay_pal_plans', 'views_limit')) {
                Schema::table('pay_pal_plans', function (Blueprint $table) {
                    $table->integer('views_limit')->default(0)->after('limit');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Não removemos a coluna no down para preservar a integridade dos dados
        // e evitar problemas com outras migrações que dependem dela
    }
};
