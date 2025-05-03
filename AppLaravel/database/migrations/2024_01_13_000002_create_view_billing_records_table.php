<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Verifica se a tabela já existe antes de criar
        if (!Schema::hasTable('view_billing_records')) {
            Schema::create('view_billing_records', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->date('billing_period_start');
                $table->date('billing_period_end');
                $table->integer('total_views');
                $table->integer('extra_views');
                $table->decimal('extra_views_cost', 10, 2);
                $table->enum('status', ['pending', 'processed', 'failed'])->default('pending');
                $table->text('notes')->nullable();
                $table->timestamps();

                // Índices
                $table->index(['user_id', 'billing_period_start']);
                $table->index('status');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('view_billing_records');
    }
};
