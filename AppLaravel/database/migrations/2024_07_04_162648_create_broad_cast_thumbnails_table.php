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
        Schema::create('broad_cast_thumbnails', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('video_detail_id')->nullable();
            $table->string('title');
            $table->text('description');
            $table->string('img_name');
            $table->string('channel_name');
            $table->string('channel_avatar');
            $table->enum('status',['pending','complete'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('broad_cast_thumbnails');
    }
};
