<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public static function tree()
    {
        return self::whereNull('parent_id')
            ->with('children')
            ->orderBy('name')
            ->get();
    }
    public function products()
    {
    return $this->belongsToMany(\App\Models\Product::class, 'category_product', 'category_id', 'product_id');
}

}
