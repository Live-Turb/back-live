<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\Type;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('criativos', function (Blueprint $table) {
            // Modificando campos existentes para atender aos requisitos
            $table->string('titulo', 100)->change()->comment('Título do criativo');

            // Adicionando novos campos
            $table->string('tag', 50)->nullable()->after('titulo')->comment('Tag para categorização/filtragem');
            $table->string('url', 2048)->nullable()->after('tag')->comment('URL para o conteúdo do criativo');
            $table->string('idioma', 10)->nullable()->after('language')->comment('Idioma do criativo (PT-BR, EN-US, etc)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('criativos', function (Blueprint $table) {
            $table->dropColumn(['tag', 'url', 'idioma']);
            // Não reverte a modificação do campo titulo para manter compatibilidade
        });
    }
};
