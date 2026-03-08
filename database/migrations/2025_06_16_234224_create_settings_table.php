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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->json('meta_content')->nullable();     // e.g., { "site_name": "My CMS", "default_description": "...", "keywords": "..." }
            $table->json('header_content')->nullable(); // e.g., { "header_mobile": "..." }
            $table->json('footer_content')->nullable(); // e.g., { "footer_mobile": "...", "footer_about_us": "...", "footer_email": "..." }
            $table->json('hero_image')->nullable();    // e.g., [ { "path": "/img/hero1.jpg", "alt": "Hero Image 1" }, { "path": "/img/hero2.jpg", "alt": "Hero Image 2" } ]
            $table->json('why_choose_us')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
