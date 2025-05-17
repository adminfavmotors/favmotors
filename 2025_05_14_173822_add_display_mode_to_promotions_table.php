<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Запускается при выполнении команды `php artisan migrate`
     */
    public function up(): void
    {
        // Добавляем колонку display_mode в таблицу promotions
        Schema::table('promotions', function (Blueprint $table) {
            // enum: два возможных значения — 'list' и 'grid'
            // default('grid') — по умолчанию в админке будет «Сетка»
            $table->enum('display_mode', ['list', 'grid'])
                  ->default('grid')
                  ->after('sort_order');
        });
    }

    /**
     * Запускается при выполнении команды `php artisan migrate:rollback`
     */
    public function down(): void
    {
        // Убираем эту колонку при откате миграции
        Schema::table('promotions', function (Blueprint $table) {
            $table->dropColumn('display_mode');
        });
    }
};
