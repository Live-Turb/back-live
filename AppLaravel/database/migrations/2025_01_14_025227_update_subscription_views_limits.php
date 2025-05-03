<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateSubscriptionViewsLimits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update Basic plan
        DB::table('pay_pal_plans')
            ->where('name', 'Basic')
            ->update(['views_limit' => 6000]);

        // Update Smart plan
        DB::table('pay_pal_plans')
            ->where('name', 'Smart')
            ->update(['views_limit' => 25000]);

        // Update Gold plan
        DB::table('pay_pal_plans')
            ->where('name', 'Gold')
            ->update(['views_limit' => 50000]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Previous values can be restored if needed
        DB::table('pay_pal_plans')
            ->where('name', 'Basic')
            ->update(['views_limit' => 6000]);

        DB::table('pay_pal_plans')
            ->where('name', 'Smart')
            ->update(['views_limit' => 25000]);

        DB::table('pay_pal_plans')
            ->where('name', 'Gold')
            ->update(['views_limit' => 50000]);
    }
}
