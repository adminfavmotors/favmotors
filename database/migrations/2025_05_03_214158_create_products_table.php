<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('product_code')->nullable();
            $table->decimal('purchase_price_netto', 10, 2)->nullable();
            $table->decimal('purchase_price_brutto', 10, 2)->nullable();
            $table->decimal('sale_price_netto', 10, 2)->nullable();
            $table->decimal('sale_price_brutto', 10, 2)->nullable();
            $table->decimal('margin_percent', 5, 2)->nullable();
            $table->string('delivery')->nullable();
            $table->text('specification')->nullable();
            $table->text('usage')->nullable();
            $table->text('replacements')->nullable();
            $table->text('oe_codes')->nullable();
            $table->string('manufacturer')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
