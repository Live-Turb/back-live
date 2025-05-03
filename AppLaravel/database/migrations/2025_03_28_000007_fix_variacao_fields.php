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
        // Desabilitar verificação de chave estrangeira
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Primeiro, vamos verificar se as colunas temporárias existem e removê-las se necessário
        if (Schema::hasColumn('anuncios', 'variacao_diaria_new')) {
            Schema::table('anuncios', function (Blueprint $table) {
                $table->dropColumn('variacao_diaria_new');
            });
        }

        if (Schema::hasColumn('anuncios', 'variacao_semanal_new')) {
            Schema::table('anuncios', function (Blueprint $table) {
                $table->dropColumn('variacao_semanal_new');
            });
        }

        if (Schema::hasColumn('anuncios', 'variacao_diaria_temp')) {
            Schema::table('anuncios', function (Blueprint $table) {
                $table->dropColumn('variacao_diaria_temp');
            });
        }

        if (Schema::hasColumn('anuncios', 'variacao_semanal_temp')) {
            Schema::table('anuncios', function (Blueprint $table) {
                $table->dropColumn('variacao_semanal_temp');
            });
        }

        // Agora vamos adicionar as colunas corretas
        Schema::table('anuncios', function (Blueprint $table) {
            $table->integer('variacao_diaria')->default(0)->after('contador_anuncios');
            $table->integer('variacao_semanal')->default(0)->after('variacao_diaria');
        });

        // Adicionar os comentários
        DB::statement("ALTER TABLE anuncios MODIFY COLUMN variacao_diaria integer NOT NULL DEFAULT 0 COMMENT 'Número absoluto de anúncios nas últimas 24h'");
        DB::statement("ALTER TABLE anuncios MODIFY COLUMN variacao_semanal integer NOT NULL DEFAULT 0 COMMENT 'Número absoluto de anúncios nos últimos 7 dias'");

        // Reabilitar verificação de chave estrangeira
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Desabilitar verificação de chave estrangeira
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Remover as colunas
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropColumn(['variacao_diaria', 'variacao_semanal']);
        });

        // Reabilitar verificação de chave estrangeira
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
};
