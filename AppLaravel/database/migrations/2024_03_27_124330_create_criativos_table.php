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
            $table->string('titulo');
            $table->string('creativeId');
            $table->string('platform');
            $table->string('language');
            $table->string('image')->nullable();
            $table->string('views')->nullable();
            $table->text('caption')->nullable();
            $table->enum('status', ['escalando', 'teste', 'pausado']);
            $table->string('value')->nullable();
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
