<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_settings', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('eyebrow_id')->nullable();
            $table->string('eyebrow_en')->nullable();
            $table->string('judul_id');
            $table->string('judul_en');
            $table->text('subjudul_id');
            $table->text('subjudul_en');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_settings');
    }
};