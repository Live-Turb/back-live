<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Verifica se a tabela já existe antes de tentar criá-la
        if (!Schema::hasTable('view_statistics')) {
            Schema::create('view_statistics', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('template_id');
                $table->unsignedBigInteger('user_id');
                $table->string('viewer_ip');
                $table->string('viewer_session')->nullable();
                $table->string('country')->nullable();
                $table->string('city')->nullable();
                $table->string('device_type');
                $table->string('browser');
                $table->string('os');
                $table->string('referrer_domain')->nullable();
                $table->text('referrer_url')->nullable();
                $table->string('utm_source')->nullable();
                $table->string('utm_medium')->nullable();
                $table->string('utm_campaign')->nullable();
                $table->integer('view_duration')->nullable();
                $table->boolean('is_unique')->default(true);
                $table->timestamps();

                $table->foreign('template_id')->references('id')->on('video_details')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->index(['template_id', 'created_at']);
                $table->index(['user_id', 'created_at']);
            });
        }
    }

    public function down()
    {
        // Não removemos a tabela aqui, pois outras migrações podem depender dela
    }
};
