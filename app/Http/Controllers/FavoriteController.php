<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Отображает страницу избранных товаров.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Получим из сессии массив избранных (ключи — ID товаров)
        $favorites = session()->get('favorites', []);

        // Здесь вы могли бы загрузить модели товаров по этим ID,
        // например:
        // $products = \App\Models\Product::whereIn('id', array_keys($favorites))->get();

        // Сейчас просто передаём в вью массив ID
        return view('favorites.index', [
            'favorites' => $favorites,
            // 'products' => $products,
        ]);
    }
}
