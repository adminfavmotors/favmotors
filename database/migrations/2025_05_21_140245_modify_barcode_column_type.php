<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('supplier_product_information', function (Blueprint $table) {
            // Просто меняем тип колонки на LONGTEXT nullable
            $table->longText('barcode')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('supplier_product_information', function (Blueprint $table) {
            // Откатываем обратно на VARCHAR(255) nullable
            $table->string('barcode', 255)->nullable()->change();
        });
    }
};
