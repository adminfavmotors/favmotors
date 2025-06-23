<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\DB;
use App\Models\SupplierProductInformation;

class ImportSupplierProductInformation extends Command
{
    // Команда: php artisan import:supplier-products {file?}
    protected $signature   = 'import:supplier-products {file?}';
    protected $description = 'Импорт данных ProductInformation из CSV (разделитель ;)';

    public function handle()
    {
        // Имя файла: аргумент или дефолт
        $fileName = $this->argument('file') ?: 'product_information.csv';
        $filePath = storage_path("app/imports/{$fileName}");

        if (! file_exists($filePath)) {
            $this->error("Файл {$fileName} не найден в storage/app/imports");
            return 1;
        }

        $this->info("Начинаем импорт {$fileName}...");

        // Лениво читаем CSV и сразу же разбиваем на чанки по 50_000 строк
        LazyCollection::make(function() use ($filePath) {
            $handle = fopen($filePath, 'r');
            $header = fgetcsv($handle, 0, ';');
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                yield array_combine($header, $row);
            }
            fclose($handle);
        })
        ->chunk(1_000)
        ->each(function($batch, $key) {
            $this->info("Обработка чанка #".($key + 1)." ({$batch->count()} записей)");

            // Подготавливаем данные для bulk upsert
            $data = $batch->map(function($row) {
                return [
                    'part_number' => $row['INDEX'],
                    'description' => $row['DESCRIPTION'] ?: null,
                    'length'      => is_numeric($row['PACKAGE_LENGTH']) ? $row['PACKAGE_LENGTH'] : null,
                    'width'       => is_numeric($row['PACKAGE_WIDTH'])  ? $row['PACKAGE_WIDTH']  : null,
                    'height'      => is_numeric($row['PACKAGE_HEIGHT']) ? $row['PACKAGE_HEIGHT'] : null,
                    'weight'      => is_numeric($row['PACKAGE_WEIGHT']) ? $row['PACKAGE_WEIGHT'] : null,
                    'barcode'     => $row['BARCODE'] ?: null,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            })->toArray();

            // Bulk-upsert: по part_number обновляем нужные поля
            DB::table('supplier_product_information')
                ->upsert(
                    $data,
                    ['part_number'],
                    ['description','length','width','height','weight','barcode','updated_at']
                );
        });

        $this->info("Импорт завершён успешно.");
        return 0;
    }
}

