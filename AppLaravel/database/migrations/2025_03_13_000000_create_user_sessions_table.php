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
        if (!Schema::hasTable('user_sessions')) {
            Schema::create('user_sessions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->string('ip_address', 45)->nullable();
                $table->string('user_agent')->nullable();
                $table->timestamp('last_activity_at')->useCurrent();
                $table->timestamps();
            });
        } else {
            Schema::table('user_sessions', function (Blueprint $table) {
                if (!Schema::hasColumn('user_sessions', 'user_id')) {
                    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('user_sessions', 'ip_address')) {
                    $table->string('ip_address', 45)->nullable();
                }
                if (!Schema::hasColumn('user_sessions', 'user_agent')) {
                    $table->string('user_agent')->nullable();
                }
                if (!Schema::hasColumn('user_sessions', 'last_activity_at')) {
                    $table->timestamp('last_activity_at')->useCurrent();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Não vamos fazer nada no down() para garantir que não perdemos dados
        return;
    }
};
