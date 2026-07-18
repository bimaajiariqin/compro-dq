<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * One row per calendar date. `count` is incremented at most once per
     * browser session per day (see HomeController::trackVisit), so a reload
     * never inflates the number.
     */
    public function up(): void
    {
        Schema::create('website_visits', function (Blueprint $table) {
            $table->id();
            $table->date('visit_date')->unique();
            $table->unsignedInteger('count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_visits');
    }
};