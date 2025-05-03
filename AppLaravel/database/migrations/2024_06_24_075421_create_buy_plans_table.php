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
        Schema::create('buy_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('plan_type');
            $table->string('plan_duration');
            $table->integer('payment');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('expiration_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buy_plans');
    }
};
