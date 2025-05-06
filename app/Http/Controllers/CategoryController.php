<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();

    // Начальный запрос
    $query = $category->products();

    // Применение фильтров из URL
    if (request()->filled('manufacturer')) {
        $query->whereIn('manufacturer', request()->get('manufacturer'));
    }

    if (request()->filled('type')) {
        $query->whereIn('type', request()->get('type'));
    }

    $products = $query->latest()->get();

    // Получаем уникальные значения для фильтров
    $manufacturers = $category->products()->distinct()->pluck('manufacturer')->filter()->unique()->toArray();
    $types = $category->products()->distinct()->pluck('type')->filter()->unique()->toArray();

    return view('categories.show', compact('category', 'products', 'manufacturers', 'types'));
}

}
