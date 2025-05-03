<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Verifica se a tabela já existe antes de criar
        if (!Schema::hasTable('template_views')) {
            Schema::create('template_views', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->unsignedBigInteger('template_id');
                $table->string('viewer_ip')->nullable();
                $table->string('viewer_session')->nullable();
                $table->string('user_agent')->nullable();
                $table->boolean('is_charged')->default(false);
                $table->timestamps();

                // Índices para melhor performance
                $table->index(['user_id', 'created_at']);
                $table->index(['template_id', 'created_at']);
            });

            // Adiciona a foreign key apenas se a tabela templates existir
            if (Schema::hasTable('templates')) {
                Schema::table('template_views', function (Blueprint $table) {
                    $table->foreign('template_id')
                          ->references('id')
                          ->on('templates')
                          ->onDelete('cascade');
                });
            }
        }
    }

    public function down()
    {
        Schema::dropIfExists('template_views');
    }
};
