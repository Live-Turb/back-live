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
        // Verificar se cada coluna existe antes de adicioná-la
        Schema::table('anuncios', function (Blueprint $table) {
            if (!Schema::hasColumn('anuncios', 'numero_anuncios')) {
                $table->integer('numero_anuncios')->default(0)
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
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropColumn([
                'numero_anuncios',
                'numero_criativos'
            ]);
        });
    }
};
