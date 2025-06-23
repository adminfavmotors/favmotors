<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('supplier_product_information', function (Blueprint $table) {
        $table->id();
        $table->string('part_number')->index();
        $table->text('description')->nullable();
        $table->decimal('length', 10, 2)->nullable();
        $table->decimal('width', 10, 2)->nullable();
        $table->decimal('height', 10, 2)->nullable();
        $table->decimal('weight', 10, 2)->nullable();
        $table->string('barcode')->nullable()->index();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('supplier_product_information');
}

};
