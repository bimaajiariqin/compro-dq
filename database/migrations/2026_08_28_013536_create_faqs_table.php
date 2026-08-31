<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori_program', ['Dakwah', 'Pendidikan', 'Ekonomi', 'Kemanusiaan']);
            $table->string('pertanyaan');
            $table->text('jawaban');
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['kategori_program', 'is_active', 'urutan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};