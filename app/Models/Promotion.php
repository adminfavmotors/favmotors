<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Promotion extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'background',
        'url',
        'subtext',
        'is_active',
        'sort_order',
	'display_products',
	'display_mode',
    ];

    protected static function booted()
    {
        static::creating(function ($promotion) {
            // Если slug не задан явно — генерируем из title
            if (empty($promotion->slug)) {
                $promotion->slug = Str::slug($promotion->title);
            }
            // И URL подставляем автоматически
            $promotion->url = '/promotions/' . $promotion->slug;
        });

        static::updating(function ($promotion) {
            // При каждом обновлении тоже синхронизируем URL с slug
            $promotion->url = '/promotions/' . $promotion->slug;
        });
    }
}
