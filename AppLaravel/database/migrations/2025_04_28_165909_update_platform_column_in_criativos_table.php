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
        Schema::table('criativos', function (Blueprint $table) {
            $table->enum('platform', ['facebook', 'instagram', 'tiktok', 'youtube'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('criativos', function (Blueprint $table) {
            $table->string('platform')->change();
        });
    }
};
