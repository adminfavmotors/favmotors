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
    Schema::create('banners', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('title');
        $table->string('subtitle')->nullable();
        $table->string('image_path');
        $table->string('link_url')->nullable();
        $table->boolean('is_active')->default(true);
        $table->integer('sort_order')->default(0);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('banners');
}

};
