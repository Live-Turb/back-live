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
        // Primeiro, vamos verificar se as colunas existem
        if (Schema::hasColumn('anuncios', 'variacao_diaria')) {
            // Criar colunas temporárias
            Schema::table('anuncios', function (Blueprint $table) {
                $table->integer('variacao_diaria_temp')->nullable()->after('variacao_diaria');
                $table->integer('variacao_semanal_temp')->nullable()->after('variacao_semanal');
            });

            // Copiar e converter os dados
            DB::statement('UPDATE anuncios SET variacao_diaria_temp = CAST(variacao_diaria AS SIGNED)');
            DB::statement('UPDATE anuncios SET variacao_semanal_temp = CAST(variacao_semanal AS SIGNED)');

            // Remover as colunas antigas
            Schema::table('anuncios', function (Blueprint $table) {
                $table->dropColumn(['variacao_diaria', 'variacao_semanal']);
            });

            // Renomear as colunas temporárias
            Schema::table('anuncios', function (Blueprint $table) {
                $table->renameColumn('variacao_diaria_temp', 'variacao_diaria');
                $table->renameColumn('variacao_semanal_temp', 'variacao_semanal');
            });

            // Adicionar os comentários
            DB::statement("ALTER TABLE anuncios MODIFY COLUMN variacao_diaria integer NOT NULL DEFAULT 0 COMMENT 'Número absoluto de anúncios nas últimas 24h'");
            DB::statement("ALTER TABLE anuncios MODIFY COLUMN variacao_semanal integer NOT NULL DEFAULT 0 COMMENT 'Número absoluto de anúncios nos últimos 7 dias'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('anuncios', 'variacao_diaria')) {
            // Criar colunas temporárias
            Schema::table('anuncios', function (Blueprint $table) {
                $table->decimal('variacao_diaria_temp', 8, 2)->nullable()->after('variacao_diaria');
                $table->decimal('variacao_semanal_temp', 8, 2)->nullable()->after('variacao_semanal');
            });

            // Copiar e converter os dados
            DB::statement('UPDATE anuncios SET variacao_diaria_temp = CAST(variacao_diaria AS DECIMAL(8,2))');
            DB::statement('UPDATE anuncios SET variacao_semanal_temp = CAST(variacao_semanal AS DECIMAL(8,2))');

            // Remover as colunas antigas
            Schema::table('anuncios', function (Blueprint $table) {
                $table->dropColumn(['variacao_diaria', 'variacao_semanal']);
            });

            // Renomear as colunas temporárias
            Schema::table('anuncios', function (Blueprint $table) {
                $table->renameColumn('variacao_diaria_temp', 'variacao_diaria');
                $table->renameColumn('variacao_semanal_temp', 'variacao_semanal');
            });

            // Adicionar os comentários
            DB::statement("ALTER TABLE anuncios MODIFY COLUMN variacao_diaria decimal(8,2) NOT NULL DEFAULT 0.00 COMMENT 'Percentual de variação de valor nas últimas 24h'");
            DB::statement("ALTER TABLE anuncios MODIFY COLUMN variacao_semanal decimal(8,2) NOT NULL DEFAULT 0.00 COMMENT 'Percentual de variação de valor nos últimos 7 dias'");
        }
    }
};
