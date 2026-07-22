<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('video_kebaikans', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->string('video_id')->nullable();
            $table->string('title')->nullable();
            $table->string('channel_name')->nullable();
            $table->string('thumbnail_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_kebaikans');
    }
};