<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Hanya dijalankan kalau kamu SUDAH SEMPAT migrate versi lama
     * (yang masih ada kolom `urutan`). Kalau belum pernah migrate sama
     * sekali, cukup pakai versi baru dari create_rekening_donasi_table
     * yang sudah tidak ada kolom ini — migration ini tidak perlu jalan.
     */
    public function up(): void
    {
        if (Schema::hasColumn('rekening_donasi', 'urutan')) {
            Schema::table('rekening_donasi', function (Blueprint $table) {
                $table->dropColumn('urutan');
            });
        }
    }

    public function down(): void
    {
        Schema::table('rekening_donasi', function (Blueprint $table) {
            $table->unsignedInteger('urutan')->default(0);
        });
    }
};