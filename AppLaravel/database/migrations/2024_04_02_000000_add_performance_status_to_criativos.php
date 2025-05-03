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
            $table->string('performance_status')->nullable()->after('status');
            $table->timestamp('last_status_change')->nullable()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('criativos', function (Blueprint $table) {
            $table->dropColumn('performance_status');
            $table->dropColumn('last_status_change');
        });
    }
};
