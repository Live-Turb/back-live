<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Só cria a tabela se ela ainda não existir
        if (!Schema::hasTable('broad_cast_comments')) {
            Schema::create('broad_cast_comments', function (Blueprint $table) {
                $table->id();
                $table->integer('video_details_id');
                $table->text('comment');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Como outras migrações podem ter criado a tabela, não vamos remover aqui
        // para evitar conflitos
    }
};
