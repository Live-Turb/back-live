<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('facebook_pixel')->nullable()->after('profile_picture');
            $table->text('google_ads_pixel')->nullable()->after('facebook_pixel');
            $table->text('tiktok_pixel')->nullable()->after('google_ads_pixel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['facebook_pixel', 'google_ads_pixel', 'tiktok_pixel']);
        });
    }
};
