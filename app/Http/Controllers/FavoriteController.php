<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Отображает страницу избранных товаров.
     */
    public function index()
    {
        $favorites = session()->get('favorites', []);

        return view('favorites.index', [
            'favorites' => $favorites,
        ]);
    }

    /**
     * Добавляет товар в список избранного.
     */
    public function add(Request $request)
    {
        $favorites = session()->get('favorites', []);

        $id    = $request->input('id');
        $name  = $request->input('name');
        $price = $request->input('price');

        if (!isset($favorites[$id])) {
            $favorites[$id] = [
                'name'  => $name,
                'price' => $price,
            ];
            session()->put('favorites', $favorites);
        }

        return redirect()->back()->with('success', 'Produkt dodany do ulubionych.');
    }

    /**
     * Удаляет товар из списка избранного.
     */
    public function remove(Request $request, $id)
    {
        $favorites = session()->get('favorites', []);
        if (isset($favorites[$id])) {
            unset($favorites[$id]);
            session()->put('favorites', $favorites);
        }

        return redirect()->route('favorites.index')->with('success', 'Produkt usunięty z ulubionych.');
    }
}
