<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            // Primeiro, atualizar value onde ele é nulo mas views tem valor
            DB::statement('
                UPDATE criativos
                SET value = views
                WHERE value IS NULL AND views IS NOT NULL
            ');

            // Remover a coluna views
            Schema::table('criativos', function (Blueprint $table) {
                $table->dropColumn('views');
            });

            // Log da operação bem-sucedida
            \Illuminate\Support\Facades\Log::info('Migration de unificação dos campos de contagem executada com sucesso');

        } catch (\Exception $e) {
            // Log do erro
            \Illuminate\Support\Facades\Log::error('Erro ao executar migration de unificação: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            // Recriar a coluna views
            Schema::table('criativos', function (Blueprint $table) {
                $table->integer('views')->nullable()->after('image');
            });

            // Copiar os valores de value para views
            DB::statement('
                UPDATE criativos
                SET views = value
                WHERE value IS NOT NULL
            ');

            // Log da operação bem-sucedida
            \Illuminate\Support\Facades\Log::info('Rollback da unificação dos campos de contagem executado com sucesso');

        } catch (\Exception $e) {
            // Log do erro
            \Illuminate\Support\Facades\Log::error('Erro ao executar rollback da unificação: ' . $e->getMessage());
            throw $e;
        }
    }
};
