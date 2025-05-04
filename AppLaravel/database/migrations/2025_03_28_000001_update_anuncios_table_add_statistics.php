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
        Schema::table('anuncios', function (Blueprint $table) {
            // Verificando se as colunas já existem antes de adicioná-las
            if (!Schema::hasColumn('anuncios', 'variacao_diaria')) {
                $table->integer('variacao_diaria')->default(0)->after('contador_anuncios')
                    ->comment('Número absoluto de anúncios nas últimas 24h');
            }

            if (!Schema::hasColumn('anuncios', 'variacao_semanal')) {
                $table->integer('variacao_semanal')->default(0)->after('variacao_diaria')
                    ->comment('Número absoluto de anúncios nos últimos 7 dias');
            }

            if (!Schema::hasColumn('anuncios', 'numero_anuncios')) {
                $table->integer('numero_anuncios')->default(0)->after('variacao_semanal')
                    ->comment('Quantidade total de anúncios associados');
            }

            if (!Schema::hasColumn('anuncios', 'numero_criativos')) {
                $table->integer('numero_criativos')->default(0)
                    ->comment('Quantidade total de criativos vinculados (calculado automaticamente)');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Não removemos as colunas no down para preservar a integridade dos dados
    }
};
