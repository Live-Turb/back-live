<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_billing_controls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('last_ip')->nullable();
            $table->string('device_fingerprint')->nullable();
            $table->decimal('pending_amount', 10, 2)->default(0);
            $table->boolean('is_blocked')->default(false);
            $table->text('block_reason')->nullable();
            $table->timestamp('last_billing_check')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('last_ip')->nullable();
            $table->string('device_fingerprint')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_billing_controls');
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_ip', 'device_fingerprint']);
        });
    }
};
