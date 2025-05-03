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
        Schema::create('video_details', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->uuid('user_id')->nullable();
            $table->string('details_video_title');
            $table->longText('details_video_description');
            $table->longText('details_video_shortcode');
            $table->double('details_video_minnum');
            $table->double('details_video_maxnum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_details');
    }
};
