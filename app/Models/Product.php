<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    // Поля, разрешённые для массового заполнения
    protected $fillable = [
        'part_number',
        'manufacturer_id',
        'article_group_id',
        'short_description',
        'state_code',
        'state_name',
        'is_active',
        'slug',
        'meta_title',
        'meta_description',
        'name',
        'price',
        'cost',
        'stock',
        'description',
        'usage',
        'crosses',
    ];

    // Касты для автоматической сериализации/десериализации
    protected $casts = [
        'description' => 'string',
        'usage'       => 'array',
        'crosses'     => 'array',
    ];

    /**
     * Производитель товара
     */
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    /**
     * Группа/категория TecDoc
     */
    public function group()
    {
        return $this->belongsTo(ProductGroup::class, 'article_group_id');
    }

    /**
     * Атрибуты товара (pivot-table product_attribute)
     */
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attribute')
                    ->withPivot('value')
                    ->withTimestamps();
    }

    /**
     * Информация от поставщика
     */
    public function supplierInfo()
    {
        return $this->hasOne(\App\Models\SupplierProductInformation::class, 'part_number', 'part_number');
    }
public function generateSlug()
{
    $manufacturer = $this->manufacturer ? $this->manufacturer->name : '';
    $slugBase = trim($manufacturer . ' ' . $this->name . ' ' . $this->part_number);
    return \Illuminate\Support\Str::slug($slugBase, '-');
}
protected static function booted()
{
    static::creating(function ($product) {
        // Генерируем slug, если его нет или если slug неуникален
        $product->slug = $product->generateSlug();
    });

    static::updating(function ($product) {
        // Обновляем slug, если изменились name, part_number или производитель
        if (
            $product->isDirty('name') ||
            $product->isDirty('part_number') ||
            $product->isDirty('manufacturer_id')
        ) {
            $product->slug = $product->generateSlug();
        }
    });
}


}
