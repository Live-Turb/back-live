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
        if (Schema::hasTable('view_statistics')) {
            Schema::table('view_statistics', function (Blueprint $table) {
                $table->unsignedBigInteger('template_id')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('view_statistics')) {
            Schema::table('view_statistics', function (Blueprint $table) {
                $table->unsignedBigInteger('template_id')->nullable(false)->change();
            });
        }
    }
};
