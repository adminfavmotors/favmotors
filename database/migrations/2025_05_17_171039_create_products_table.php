<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Добавляем уникальный артикул детали
            $table->string('part_number', 100)
                  ->unique()
                  ->after('id');

            // Ссылка на производителя (nullable, пока без FK)
            $table->unsignedBigInteger('manufacturer_id')
                  ->nullable()
                  ->after('slug');

            // Ссылка на группу/категорию TecDoc (nullable)
            $table->unsignedBigInteger('article_group_id')
                  ->nullable()
                  ->after('manufacturer_id');

            // Краткое описание (если есть)
            $table->string('short_description')
                  ->nullable()
                  ->after('article_group_id');

            // Код состояния (например '00')
            $table->string('state_code', 10)
                  ->nullable()
                  ->after('short_description');

            // Название состояния (например 'Normal')
            $table->string('state_name', 50)
                  ->nullable()
                  ->after('state_code');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'part_number',
                'manufacturer_id',
                'article_group_id',
                'short_description',
                'state_code',
                'state_name',
            ]);
        });
    }
};
