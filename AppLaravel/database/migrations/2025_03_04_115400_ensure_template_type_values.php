<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            // Primeiro verifica se a coluna existe
            if (Schema::hasColumn('video_details', 'template_type')) {
                // Contagem de registros antes da atualização
                $nullCount = DB::table('video_details')
                    ->whereNull('template_type')
                    ->orWhere('template_type', '')
                    ->count();
                
                // Registra quantos registros serão atualizados
                Log::info("Migração 2025_03_04_115400: {$nullCount} registros serão atualizados na tabela video_details");
                
                // Atualiza apenas registros com template_type NULL ou vazio
                // Não afeta registros existentes que já têm um valor
                DB::table('video_details')
                    ->whereNull('template_type')
                    ->orWhere('template_type', '')
                    ->update(['template_type' => 'youtube']);
                
                // Verifica se a atualização foi bem-sucedida
                $remainingNullCount = DB::table('video_details')
                    ->whereNull('template_type')
                    ->orWhere('template_type', '')
                    ->count();
                
                Log::info("Migração 2025_03_04_115400: Atualização concluída. {$remainingNullCount} registros ainda estão sem template_type definido.");
            } else {
                Log::warning("Migração 2025_03_04_115400: A coluna template_type não existe na tabela video_details. A migração não pode continuar.");
            }
        } catch (\Exception $e) {
            // Registra qualquer exceção ocorrida durante a migração
            Log::error("Erro na migração 2025_03_04_115400: " . $e->getMessage());
            // Não lança a exceção para não interromper o processo de migração
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Não precisa fazer nada no método down, pois
        // não queremos reverter as atualizações de dados
        Log::info("Migração 2025_03_04_115400: Método down não faz alterações, pois isso poderia resultar em perda de dados.");
    }
};
