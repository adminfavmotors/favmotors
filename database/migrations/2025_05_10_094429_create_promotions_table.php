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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title');            // Заголовок акции на польском
            $table->string('slug')->unique();   // Уникальный идентификатор для URL
            $table->string('background');       // Имя файла фонового изображения
            $table->string('url');              // Ссылка, куда ведёт баннер
            $table->text('subtext')->nullable();// Дополнительный текст (необязательно)
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
