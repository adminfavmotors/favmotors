<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
