<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Filtr oleju Bosch',
                'slug' => Str::slug('Filtr oleju Bosch'),
                'product_code' => 'BOSCH-1234',
                'purchase_price_netto' => 20.00,
                'purchase_price_brutto' => 24.60,
                'sale_price_netto' => 30.00,
                'sale_price_brutto' => 36.90,
                'margin_percent' => 50,
                'delivery' => '24h',
                'specification' => 'Filtr oleju do silników benzynowych',
                'usage' => 'Pasuje do VW Golf, Audi A3',
                'replacements' => 'Filtron OP-123',
                'oe_codes' => 'OE123456',
                'manufacturer' => 'Bosch',
                'category_id' => null,
            ],
            [
                'name' => 'Klocki hamulcowe Ferodo',
                'slug' => Str::slug('Klocki hamulcowe Ferodo'),
                'product_code' => 'FERODO-5678',
                'purchase_price_netto' => 80.00,
                'purchase_price_brutto' => 98.40,
                'sale_price_netto' => 110.00,
                'sale_price_brutto' => 135.30,
                'margin_percent' => 37.5,
                'delivery' => '48h',
                'specification' => 'Klocki hamulcowe na przód',
                'usage' => 'Pasuje do Opel Astra, Ford Focus',
                'replacements' => 'TRW GDB1234',
                'oe_codes' => 'OE987654',
                'manufacturer' => 'Ferodo',
                'category_id' => null,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
