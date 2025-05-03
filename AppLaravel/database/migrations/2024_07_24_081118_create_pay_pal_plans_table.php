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
        Schema::create('pay_pal_plans', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name');
            $table->string('plan_key');
            $table->string('stripe_plan_key')->nullable();
            $table->integer('comment_limit');
            $table->integer('step');
            $table->double('price');
            $table->integer('limit');
            // $table->enum('type', ['Basic', 'Standard', 'Premium']);
            $table->integer('duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_pal_plans');
    }
};
