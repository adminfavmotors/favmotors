<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('product_code')->nullable()->after('id');
            $table->decimal('purchase_price_netto', 10, 2)->nullable()->after('description');
            $table->decimal('purchase_price_brutto', 10, 2)->nullable()->after('purchase_price_netto');
            $table->decimal('sale_price_netto', 10, 2)->nullable()->after('purchase_price_brutto');
            $table->decimal('sale_price_brutto', 10, 2)->nullable()->after('sale_price_netto');
            $table->integer('markup_percentage')->default(0)->after('sale_price_brutto');
            $table->string('delivery_time')->nullable()->after('stock');
            $table->text('specification')->nullable()->after('delivery_time');
            $table->text('application')->nullable()->after('specification');
            $table->text('replacements')->nullable()->after('application');
            $table->text('oe_codes')->nullable()->after('replacements');
            $table->string('manufacturer')->nullable()->after('oe_codes');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'product_code',
                'purchase_price_netto',
                'purchase_price_brutto',
                'sale_price_netto',
                'sale_price_brutto',
                'markup_percentage',
                'delivery_time',
                'specification',
                'application',
                'replacements',
                'oe_codes',
                'manufacturer',
            ]);
        });
    }
};
