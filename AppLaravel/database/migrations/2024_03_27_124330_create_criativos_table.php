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
        Schema::create('criativos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anuncio_id')->constrained('anuncios')->onDelete('cascade');
            $table->string('titulo', 100)->comment('Título do criativo');
            $table->string('tag', 50)->nullable()->comment('Tag para categorização/filtragem');
            $table->string('url', 2048)->nullable()->comment('URL para o conteúdo do criativo');
            $table->string('creativeId');
            $table->string('platform');
            $table->string('language');
            $table->string('idioma', 10)->nullable()->comment('Idioma do criativo (PT-BR, EN-US, etc)');
            $table->string('image')->nullable();
            $table->integer('views')->default(0);
            $table->text('caption')->nullable();
            $table->string('status');
            $table->decimal('value', 10, 2)->default(0.00);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criativos');
    }
};
