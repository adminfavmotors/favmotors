<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierProductInformation extends Model
{
    // Явно указываем имя таблицы
    protected $table = 'supplier_product_information';

    // Поля, которые можно массово заполнять
    protected $fillable = [
        'part_number',
        'description',
        'length',
        'width',
        'height',
        'weight',
        'barcode',
    ];
}
