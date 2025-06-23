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
	Schema::create('product_crosses', function (Blueprint $table) {
	    $table->id();
	    // Ссылка на основной товар
	    $table->foreignId('product_id')
	          ->constrained('products')
	          ->onDelete('cascade');
	    // Ссылка на заменяющий товар
	    $table->foreignId('cross_product_id')
	          ->constrained('products')
	          ->onDelete('cascade');
	    // Тип связи (например, 'замена', 'аналог')
	    $table->string('relation_type')->nullable();
	    $table->timestamps();
	});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_crosses');
    }
};
