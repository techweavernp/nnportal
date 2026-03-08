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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('menus')->cascadeOnDelete();
            $table->string('name');
            $table->string('url')->nullable();
            $table->tinyInteger('menu_order')->default(0);
            $table->nullableMorphs('linkable');
            $table->boolean('is_active')->default(true);
            $table->char('menu_type', 2)->default('MM')->comment('MM-Main Menu, FM-footer menu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
