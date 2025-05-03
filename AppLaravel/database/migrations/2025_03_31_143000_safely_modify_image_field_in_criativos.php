<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Doctrine\DBAL\Types\Type;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            // Primeiro, fazer backup dos dados existentes
            $criativos = DB::table('criativos')->get();

            // Modificar a coluna para aceitar NULL de forma segura
            Schema::table('criativos', function (Blueprint $table) {
                $table->string('image')->nullable()->change();
            });

            // Log da operação bem-sucedida
            \Illuminate\Support\Facades\Log::info('Migration executada com sucesso: campo image da tabela criativos alterado para nullable');

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
            Schema::table('criativos', function (Blueprint $table) {
                $table->string('image')->nullable(false)->change();
            });

            // Log da operação bem-sucedida
            \Illuminate\Support\Facades\Log::info('Rollback executado com sucesso: campo image da tabela criativos alterado para not null');

        } catch (\Exception $e) {
            // Log do erro
            \Illuminate\Support\Facades\Log::error('Erro ao executar rollback: ' . $e->getMessage());
            throw $e;
        }
    }
};
