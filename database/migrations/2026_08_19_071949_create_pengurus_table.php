<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengurus', function (Blueprint $table) {
            $table->id();
            $table->string('kelompok', 100);
            $table->string('nama', 150)->nullable();
            $table->string('jabatan', 150)->nullable();
            $table->string('foto')->nullable();
            $table->boolean('is_ketua')->default(false);
            $table->unsignedInteger('urutan_grup')->default(0);
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengurus');
    }
};