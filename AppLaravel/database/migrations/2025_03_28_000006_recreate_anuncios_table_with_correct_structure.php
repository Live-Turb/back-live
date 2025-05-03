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

        // Modificar as colunas para o tipo correto
        Schema::table('anuncios', function (Blueprint $table) {
            $table->integer('variacao_diaria')->change();
            $table->integer('variacao_semanal')->change();
        });

        // Converter os valores existentes para inteiros
        DB::statement('UPDATE anuncios SET variacao_diaria = CAST(variacao_diaria AS SIGNED)');
        DB::statement('UPDATE anuncios SET variacao_semanal = CAST(variacao_semanal AS SIGNED)');

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

        // Reverter as colunas para decimal
        Schema::table('anuncios', function (Blueprint $table) {
            $table->decimal('variacao_diaria', 8, 2)->change();
            $table->decimal('variacao_semanal', 8, 2)->change();
        });

        // Reabilitar verificação de chave estrangeira
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
};
