<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('berita', 'thumbnail')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->string('thumbnail')->nullable()->after('judul');
            });
        }
    }

    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn('thumbnail');
        });
    }
};