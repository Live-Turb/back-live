<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('view_billing_records')) {
            Schema::create('view_billing_records', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->dateTime('billing_period_start');
                $table->dateTime('billing_period_end');
                $table->integer('total_views')->default(0);
                $table->integer('extra_views')->default(0);
                $table->decimal('extra_views_cost', 10, 2)->default(0);
                $table->enum('status', ['pending', 'processed', 'failed'])->default('pending');
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('view_billing_records');
    }
};
