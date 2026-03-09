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
        Schema::create('ad_lists', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('banner, sidebar, header, footer');
            $table->string('image');
            $table->string('position')->comment('e.g., sidebar, header_top, footer_bottom');
            $table->boolean('is_active')->default(true);
            $table->string('callback_url')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();

            $table->index(['position', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_lists');
    }
};
