<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_attribute', function (Blueprint $table) {
            $table->id();
            // Связь с таблицей products
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');

            // Связь с таблицей attributes
            $table->foreignId('attribute_id')
                  ->constrained('attributes')
                  ->onDelete('cascade');

            // Значение атрибута
            $table->string('value')->nullable();

            // (По желанию) метки времени
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_attribute');
    }
};
