<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            // Уникальный код атрибута (из TecDoc – например, 6, 67 и т.п.)
            $table->string('code')->unique()->comment('Уникальный код атрибута');
            // Читаемое название атрибута
            $table->string('name')->comment('Читаемое название атрибута');
            // Тип данных (Numeric, Alphanumeric, WithAttributeTable и т.п.)
            $table->string('data_type')->comment('Тип данных атрибута');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
