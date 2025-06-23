<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
$path = database_path('seeders/attributes.csv');
if (!file_exists($path)) {
    $this->command->error('Файл attributes.csv не найден в database/seeders');
    return;
}

$handle = fopen($path, 'r');
// Пропустить заголовок
fgetcsv($handle);

while (($data = fgetcsv($handle, 1000, ',')) !== false) {
    \App\Models\Attribute::updateOrCreate(
        ['code' => $data[0]],
        ['name' => $data[1], 'data_type' => $data[2]]
    );
}
fclose($handle);
    }
}
