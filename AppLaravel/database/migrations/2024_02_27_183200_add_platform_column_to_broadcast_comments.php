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
        // Cria a tabela se ela não existir
        if (!Schema::hasTable('broad_cast_comments')) {
            Schema::create('broad_cast_comments', function (Blueprint $table) {
                $table->id();
                $table->integer('video_details_id');
                $table->text('comment');
                $table->enum('platform', ['youtube', 'instagram'])->nullable();
                $table->timestamps();
            });
        } else if (!Schema::hasColumn('broad_cast_comments', 'platform')) {
            // Adiciona a coluna platform se a tabela já existir mas não tiver a coluna
            Schema::table('broad_cast_comments', function (Blueprint $table) {
                // Adiciona a coluna platform após a coluna comment
                $table->enum('platform', ['youtube', 'instagram'])->after('comment')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Se a tabela existir e tiver a coluna, remove a coluna
        if (Schema::hasTable('broad_cast_comments') && Schema::hasColumn('broad_cast_comments', 'platform')) {
            Schema::table('broad_cast_comments', function (Blueprint $table) {
                $table->dropColumn('platform');
            });
        }
    }
};
