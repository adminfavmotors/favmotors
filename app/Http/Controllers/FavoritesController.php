<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function index()
    {
        $favorites = session()->get('favorites', []);
        return view('favorites.index', compact('favorites'));
    }

    public function add(Request $request)
    {
        $id = $request->input('product_id');
        $name = $request->input('name');
        $price = $request->input('price');

        $favorites = session()->get('favorites', []);
        $favorites[$id] = ['name' => $name, 'price' => $price];

        session()->put('favorites', $favorites);

        return redirect()->back()->with('success', 'Produkt dodany do ulubionych.');
    }

    public function remove(Request $request)
    {
        $id = $request->input('product_id');

        $favorites = session()->get('favorites', []);
        unset($favorites[$id]);

        session()->put('favorites', $favorites);

        return redirect()->back()->with('success', 'Produkt usunięty z ulubionych.');
    }
}
