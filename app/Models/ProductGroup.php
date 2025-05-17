<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    use HasFactory;

    // Массив полей, которые можно массово заполнять
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];

    /**
     * Родительская группа (если есть)
     */
    public function parent()
    {
        return $this->belongsTo(ProductGroup::class, 'parent_id');
    }

    /**
     * Дочерние группы
     */
    public function children()
    {
        return $this->hasMany(ProductGroup::class, 'parent_id');
    }

    /**
     * Товары этой группы
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'article_group_id');
    }
}
