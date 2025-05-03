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
        Schema::table('anuncios', function (Blueprint $table) {
            // Primeiro, adicionamos as novas colunas como nullable
            $table->integer('variacao_diaria_new')->nullable()->after('contador_anuncios');
            $table->integer('variacao_semanal_new')->nullable()->after('variacao_diaria_new');
        });

        // Atualizamos os dados existentes
        DB::statement('UPDATE anuncios SET variacao_diaria_new = CAST(variacao_diaria AS SIGNED)');
        DB::statement('UPDATE anuncios SET variacao_semanal_new = CAST(variacao_semanal AS SIGNED)');

        Schema::table('anuncios', function (Blueprint $table) {
            // Removemos as colunas antigas
            $table->dropColumn(['variacao_diaria', 'variacao_semanal']);

            // Renomeamos as novas colunas
            $table->renameColumn('variacao_diaria_new', 'variacao_diaria');
            $table->renameColumn('variacao_semanal_new', 'variacao_semanal');

            // Adicionamos os comentários
            DB::statement("ALTER TABLE anuncios MODIFY COLUMN variacao_diaria integer COMMENT 'Número absoluto de anúncios nas últimas 24h'");
            DB::statement("ALTER TABLE anuncios MODIFY COLUMN variacao_semanal integer COMMENT 'Número absoluto de anúncios nos últimos 7 dias'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anuncios', function (Blueprint $table) {
            // Primeiro, adicionamos as colunas antigas como nullable
            $table->decimal('variacao_diaria_old', 8, 2)->nullable()->after('contador_anuncios');
            $table->decimal('variacao_semanal_old', 8, 2)->nullable()->after('variacao_diaria_old');
        });

        // Restauramos os dados
        DB::statement('UPDATE anuncios SET variacao_diaria_old = CAST(variacao_diaria AS DECIMAL(8,2))');
        DB::statement('UPDATE anuncios SET variacao_semanal_old = CAST(variacao_semanal AS DECIMAL(8,2))');

        Schema::table('anuncios', function (Blueprint $table) {
            // Removemos as novas colunas
            $table->dropColumn(['variacao_diaria', 'variacao_semanal']);

            // Renomeamos as colunas antigas
            $table->renameColumn('variacao_diaria_old', 'variacao_diaria');
            $table->renameColumn('variacao_semanal_old', 'variacao_semanal');

            // Restauramos os comentários
            DB::statement("ALTER TABLE anuncios MODIFY COLUMN variacao_diaria decimal(8,2) COMMENT 'Percentual de variação de valor nas últimas 24h'");
            DB::statement("ALTER TABLE anuncios MODIFY COLUMN variacao_semanal decimal(8,2) COMMENT 'Percentual de variação de valor nos últimos 7 dias'");
        });
    }
};
