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
        // Primeiro verifica se a coluna não existe para evitar erros
        if (!Schema::hasColumn('video_details', 'template_type')) {
            Schema::table('video_details', function (Blueprint $table) {
                // Adiciona a coluna com valor padrão 'youtube' para registros existentes
                $table->string('template_type')->default('youtube')->after('details_video_maxnum');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Verifica se a coluna existe antes de tentar removê-la
        if (Schema::hasColumn('video_details', 'template_type')) {
            Schema::table('video_details', function (Blueprint $table) {
                $table->dropColumn('template_type');
            });
        }
    }
};
