<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    // Разрешённые для массового заполнения поля
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Товары этого производителя
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
