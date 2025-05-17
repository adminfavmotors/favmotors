<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ManufacturerSeeder extends Seeder
{
    public function run(): void
    {
        $file = base_path('tecdoc-csv/manufacturers.csv');

        if (! file_exists($file)) {
            $this->command->error("Файл manufacturers.csv не найден в папке tecdoc-csv");
            return;
        }

        $handle = fopen($file, 'r');
        if (! $handle) {
            $this->command->error("Не удалось открыть файл $file");
            return;
        }

        // Очищаем таблицу перед импортом
        DB::table('manufacturers')->truncate();

        while (($line = fgetcsv($handle, 0, "\t")) !== false) {
            // Структура: [0] => ID, [1] => Code, [2] => Flag, [3] => Name, ...
            $id   = trim($line[0]);
            $name = trim($line[3]) ?: trim($line[1]);

            if (! $name) {
                continue;
            }

            // Пропускаем дубликаты по имени
            if (DB::table('manufacturers')->where('name', $name)->exists()) {
                continue;
            }

            // Генерируем уникальный slug
            $slugBase = Str::slug($name);
            $slug = $slugBase . '-' . $id;

            DB::table('manufacturers')->insert([
                'id'         => $id,
                'name'       => $name,
                'slug'       => $slug,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        fclose($handle);

        $this->command->info('Производители успешно импортированы из TecDoc CSV.');
    }
}
