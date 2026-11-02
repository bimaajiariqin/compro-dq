<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videopertanyaan', function (Blueprint $table) {
            $table->id();
            $table->string('link', 500);
            $table->string('video_id', 20);
            $table->string('title')->nullable();
            $table->string('channel_name')->nullable();
            $table->string('thumbnail_url', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videopertanyaan');
    }
};