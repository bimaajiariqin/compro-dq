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
        Schema::create('cerita_penerima_manfaat', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('jabatan', 150)->nullable();
            $table->enum('kategori_program', ['Pendidikan', 'Ekonomi', 'Dakwah', 'Kemanusiaan']);
            $table->string('foto')->nullable(); // disimpan relatif ke storage/app/public
            $table->text('isi_cerita');
            $table->unsignedInteger('urutan')->default(0); // untuk urutan tampil di slider
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('kategori_program');
            $table->index(['kategori_program', 'is_active', 'urutan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cerita_penerima_manfaat');
    }
};