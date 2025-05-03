<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            // Verificar se a tabela existe
            if (!Schema::hasTable('criativos')) {
                \Illuminate\Support\Facades\Log::error('Tabela criativos não encontrada');
                return;
            }

            // Fazer backup dos dados existentes
            $criativos = DB::table('criativos')->get();

            // Modificar a coluna para aceitar NULL
            DB::statement('ALTER TABLE criativos MODIFY COLUMN image VARCHAR(255) NULL');

            // Log da operação bem-sucedida
            \Illuminate\Support\Facades\Log::info('Migration executada com sucesso: campo image da tabela criativos alterado para nullable');
            \Illuminate\Support\Facades\Log::info('Número de registros preservados: ' . count($criativos));

        } catch (\Exception $e) {
            // Log do erro
            \Illuminate\Support\Facades\Log::error('Erro ao executar migration: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            // Primeiro, atualizar registros NULL para string vazia
            DB::table('criativos')->whereNull('image')->update(['image' => '']);

            // Então modificar a coluna para não aceitar NULL
            DB::statement('ALTER TABLE criativos MODIFY COLUMN image VARCHAR(255) NOT NULL');

            // Log da operação bem-sucedida
            \Illuminate\Support\Facades\Log::info('Rollback executado com sucesso: campo image da tabela criativos alterado para not null');

        } catch (\Exception $e) {
            // Log do erro
            \Illuminate\Support\Facades\Log::error('Erro ao executar rollback: ' . $e->getMessage());
            throw $e;
        }
    }
};
