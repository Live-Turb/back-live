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
        Schema::table('view_statistics', function (Blueprint $table) {
            if (!Schema::hasColumn('view_statistics', 'user_agent')) {
                $table->string('user_agent')->nullable()->after('viewer_session');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('view_statistics', function (Blueprint $table) {
            if (Schema::hasColumn('view_statistics', 'user_agent')) {
                $table->dropColumn('user_agent');
            }
        });
    }
};
