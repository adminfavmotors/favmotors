<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_groups', function (Blueprint $table) {
            $table->id();
            // Название категории
            $table->string('name')->comment('Название группы/категории');
            // Уникальный URL-slug
            $table->string('slug')->unique()->comment('URL-ключ категории');
            // Для вложенных категорий
            $table->foreignId('parent_id')
                  ->nullable()
                  ->constrained('product_groups')
                  ->nullOnDelete()
                  ->comment('Родительская категория');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_groups');
    }
};
