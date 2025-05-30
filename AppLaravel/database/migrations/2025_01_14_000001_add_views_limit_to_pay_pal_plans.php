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
        Schema::table('pay_pal_plans', function (Blueprint $table) {
            if (!Schema::hasColumn('pay_pal_plans', 'views_limit')) {
                $table->integer('views_limit')->default(0)->after('limit');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pay_pal_plans', function (Blueprint $table) {
            if (Schema::hasColumn('pay_pal_plans', 'views_limit')) {
                $table->dropColumn('views_limit');
            }
        });
    }
};
