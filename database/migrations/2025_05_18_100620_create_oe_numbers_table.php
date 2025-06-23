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
	Schema::create('oe_numbers', function (Blueprint $table) {
	    $table->id();
	    $table->foreignId('product_id')
	          ->constrained('products')
	          ->onDelete('cascade');
	    $table->string('oe_code');
	    $table->timestamps();
	});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oe_numbers');
    }
};
