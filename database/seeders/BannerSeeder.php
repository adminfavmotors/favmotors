<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        Banner::create([
            'title'      => 'Wiosenna dostawa',
            'subtitle'   => 'Rabaty do 20% na oleje i filtry',
            'image_path' => 'banners/spring_sale.jpg',
            'link_url'   => '/sale/spring',
            'is_active'  => true,
            'sort_order' => 1,
        ]);

        Banner::create([
            'title'      => 'Nowości od Bosch',
            'subtitle'   => 'Tylko oryginalne części',
            'image_path' => 'banners/bosch_new.jpg',
            'link_url'   => '/brands/bosch',
            'is_active'  => true,
            'sort_order' => 2,
        ]);

        Banner::create([
            'title'      => 'Darmowa dostawa',
            'subtitle'   => 'Przy zamówieniach powyżej 200 zł',
            'image_path' => 'banners/free_shipping.jpg',
            'link_url'   => '/info/delivery',
            'is_active'  => true,
            'sort_order' => 3,
        ]);
    }
}
