<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $categories = [
            'Układ hamulcowy' => [
                'Klocki hamulcowe',
                'Tarcze hamulcowe',
                'Przewody hamulcowe',
                'Zaciski',
                'Bębny',
                'Linki hamulca ręcznego',
            ],
            'Filtr' => [
                'Filtr oleju',
                'Filtr powietrza',
                'Filtr paliwa',
                'Filtr kabinowy',
                'Zestawy filtrów',
            ],
            'Układ zawieszenia' => [
                'Wahacze',
                'Tuleje',
                'Łączniki stabilizatora',
                'Sworznie',
                'Amortyzatory',
                'Sprężyny',
            ],
            'Układ kierowniczy' => [
                'Drążki kierownicze',
                'Końcówki drążków',
                'Przekładnie kierownicze',
                'Pompy wspomagania',
            ],
            'Części silnikowe' => [
                'Uszczelki',
                'Zestawy rozrządu',
                'Zawory',
                'Popychacze',
                'Tłoki',
                'Panewki',
            ],
            'Układ wydechowy' => [
                'Tłumiki',
                'Rury wydechowe',
                'Katalizatory',
                'Sondy lambda',
                'Uszczelki wydechu',
            ],
            'Sprzęgło' => [
                'Zestawy sprzęgła',
                'Dociski',
                'Tarcze sprzęgła',
                'Wysprzęgliki',
                'Łożyska oporowe',
            ],
            'Układ chłodzenia' => [
                'Chłodnice',
                'Pompy wodne',
                'Termostaty',
                'Wentylatory',
                'Zbiorniki wyrównawcze',
            ],
            'Nadwozie' => [
                'Zderzaki',
                'Błotniki',
                'Maski',
                'Lusterka',
                'Drzwi',
                'Oświetlenie zewnętrzne',
            ],
            'Świece zapłonowe' => [
                'Świece zapłonowe',
                'Przewody zapłonowe',
                'Cewki zapłonowe',
            ],
            'Wyposażenie wnętrza' => [
                'Dywaniki',
                'Gałki zmiany biegów',
                'Kierownice',
                'Fotele',
                'Konsola środkowa',
            ],
            'Oleje i płyny' => [
                'Olej silnikowy',
                'Płyn chłodniczy',
                'Płyn hamulcowy',
                'Płyn do wspomagania',
                'Płyn do spryskiwaczy',
            ],
            'Elektryka' => [
                'Akumulatory',
                'Alternatory',
                'Rozruszniki',
                'Bezpieczniki',
                'Przekaźniki',
                'Czujniki',
            ],
            'Oświetlenie' => [
                'Żarówki',
                'Reflektory',
                'Lampy tylne',
                'Kierunkowskazy',
                'Światła przeciwmgielne',
            ],
            'Akcesoria' => [
                'Pokrowce',
                'Bagażniki dachowe',
                'Uchwyty na telefon',
                'Kamery cofania',
                'Apteczki',
                'Gaśnice',
            ],
        ];

        foreach ($categories as $parent => $children) {
            $parentId = DB::table('categories')->insertGetId([
                'name' => $parent,
                'slug' => Str::slug($parent),
                'parent_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($children as $child) {
                DB::table('categories')->insert([
                    'name' => $child,
                    'slug' => Str::slug($child),
                    'parent_id' => $parentId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
