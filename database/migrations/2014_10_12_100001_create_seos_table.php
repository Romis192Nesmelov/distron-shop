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
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_twitter_card')->nullable();
            $table->string('meta_twitter_size')->nullable();
            $table->string('meta_twitter_creator')->nullable();
            $table->string('meta_og_url')->nullable();
            $table->string('meta_og_type')->nullable();
            $table->string('meta_og_title')->nullable();
            $table->string('meta_og_description')->nullable();
            $table->string('meta_og_image')->nullable();
            $table->string('meta_robots')->nullable();
            $table->string('meta_googlebot')->nullable();
            $table->string('meta_google_site_verification')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seos');
    }
};
