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
            $table->string('title')->comment('3D-box, banner-after-news, sidebar-al, sidebar-bl, header-banner, footer-banner');
            $table->string('description');
        });

        Schema::create('ad_campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('ad_list_id')->constrained()->onDelete('cascade');
            $table->text('image');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('display_order')->default(0);
            $table->string('link_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->double('payment_amount')->default(0);
            $table->boolean('is_paid')->default(false);
            $table->timestamp('payment_date')->nullable();
            $table->char('payment_mode', 1)->nullable()->default('C')->comment('B bank, C cash,  O online, Q cheque');

            $table->timestamps();

            $table->index(['start_date', 'end_date']);
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_campaigns');
        Schema::dropIfExists('ad_lists');
    }
};
