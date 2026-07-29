<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_pokok', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori_program', ['Pendidikan', 'Ekonomi', 'Dakwah', 'Kemanusiaan']);
            $table->string('judul', 150);
            $table->text('deskripsi');
            $table->string('icon', 255)->nullable();
            $table->string('link', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_pokok');
    }
};