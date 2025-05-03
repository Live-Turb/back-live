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
        // Verifica se a coluna não existe antes de criar
        if (!Schema::hasColumn('broad_cast_comments', 'platform')) {
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
        // Verifica se a coluna existe antes de remover
        if (Schema::hasColumn('broad_cast_comments', 'platform')) {
            Schema::table('broad_cast_comments', function (Blueprint $table) {
                $table->dropColumn('platform');
            });
        }
    }
};
