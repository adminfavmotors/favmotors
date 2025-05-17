<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Banner extends Model
{
protected $fillable = [
    'title',
    'subtitle',
    'image_path',
    'link_url',
    'is_active',
    'sort_order',
];

 protected static function booted(): void
    {
        static::saving(function (Banner $banner) {
            // если поле link_url пусто — генерим
            if (empty($banner->link_url)) {
                // префикс "/promo/" можно поменять на любой нужный
                $banner->link_url = '/promo/' . Str::slug($banner->title);
            }
        });
    }
}
