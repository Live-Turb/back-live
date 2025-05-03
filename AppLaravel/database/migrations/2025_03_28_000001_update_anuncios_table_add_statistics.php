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
            // Adicionando os novos campos solicitados
            $table->integer('variacao_diaria')->default(0)->after('contador_anuncios')
                ->comment('Número absoluto de anúncios nas últimas 24h');
            $table->integer('variacao_semanal')->default(0)->after('variacao_diaria')
                ->comment('Número absoluto de anúncios nos últimos 7 dias');
            $table->integer('numero_anuncios')->default(0)->after('variacao_semanal')
                ->comment('Quantidade total de anúncios associados');
            $table->integer('numero_criativos')->default(0)->after('numero_anuncios')
                ->comment('Quantidade total de criativos vinculados (calculado automaticamente)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropColumn([
                'variacao_diaria',
                'variacao_semanal',
                'numero_anuncios',
                'numero_criativos'
            ]);
        });
    }
};
