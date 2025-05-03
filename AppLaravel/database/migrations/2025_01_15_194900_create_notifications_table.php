<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Primeiro, vamos marcar a migração antiga como executada
        if (!Schema::hasTable('view_billing_records')) {
            Schema::create('view_billing_records', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->date('billing_period_start');
                $table->date('billing_period_end');
                $table->integer('total_views');
                $table->integer('extra_views');
                $table->decimal('extra_views_cost', 10, 2);
                $table->enum('status', ['pending', 'processed', 'failed'])->default('pending');
                $table->json('notes')->nullable();
                $table->timestamps();

                // Índices
                $table->index('user_id');
                $table->index(['user_id', 'status']);
                $table->index(['user_id', 'billing_period_start', 'billing_period_end']);
            });
        }

        // Agora criamos a tabela de notificações
        if (!Schema::hasTable('notifications')) {
            Schema::create('notifications', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('type');
                $table->morphs('notifiable');
                $table->text('data');
                $table->timestamp('read_at')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
