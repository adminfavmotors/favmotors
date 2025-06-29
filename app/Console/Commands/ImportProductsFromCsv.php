<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class ImportProductsFromCsv extends Command
{
    protected $signature = 'import:products-csv';
    protected $description = 'Импорт товаров из CSV-файла ProductInformation_PL_2025-05-21.csv чанками через upsert';

    public function handle(): int
    {
        $path = storage_path('app/imports/ProductInformation_PL_2025-05-21.csv');
        if (! file_exists($path)) {
            $this->error("File not found: {$path}");
            return self::FAILURE;
        }

        // Чтение заголовков
        $fileHandle = fopen($path, 'r');
        $headers = fgetcsv($fileHandle, 0, ';');
        fclose($fileHandle);

        // Определяем индексы нужных колонок
        $indexCol   = array_search('INDEX', $headers);
        $descCol    = array_search('DESCRIPTION', $headers);
        $barcodeCol = array_search('BARCODE', $headers);
        $tecDocCol  = array_search('TEC_DOC', $headers);

        if ($tecDocCol === false || $descCol === false) {
            $this->error('Columns TEC_DOC or DESCRIPTION not found.');
            return self::FAILURE;
        }

        $this->info('Starting CSV import with detailed mapping...');

        LazyCollection::make(function () use ($path) {
            $handle = fopen($path, 'r');
            fgetcsv($handle, 0, ';'); // пропустить заголовок
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                yield $row;
            }
            fclose($handle);
        })
        ->chunk(1000)
        ->each(function (LazyCollection $chunk) use ($headers, $indexCol, $descCol, $barcodeCol, $tecDocCol) {
            $rows = [];
            foreach ($chunk as $row) {
                // Универсальный артикул из TEC_DOC, или fallback INDEX
                $partNumber = trim($row[$tecDocCol] ?? $row[$indexCol] ?? '');
                $description = trim($row[$descCol] ?? '');
                if ($partNumber === '') {
                    continue;
                }
                // Обработка штрих-кодов в JSON
                $barcodes = [];
                if ($barcodeCol !== false && ! empty($row[$barcodeCol])) {
                    $barcodes = array_filter(array_map('trim', explode(',', $row[$barcodeCol])));
                }

                $rows[] = [
                    'part_number' => $partNumber,
                    'name'        => $description,
                    'slug'        => Str::slug($partNumber),
                    'description' => $description,
                    'usage'       => $description,
                    'crosses'     => ! empty($barcodes) ? json_encode($barcodes, JSON_UNESCAPED_UNICODE) : null,
                    'updated_at'  => now(),
                    'created_at'  => now(),
                ];
            }

            if (! empty($rows)) {
                DB::table('products')
                    ->upsert(
                        $rows,
                        ['part_number'],
                        ['name', 'slug', 'description', 'usage', 'crosses', 'updated_at']
                    );
            }
        });

        $this->info('Import completed successfully.');
        return self::SUCCESS;
    }
}
