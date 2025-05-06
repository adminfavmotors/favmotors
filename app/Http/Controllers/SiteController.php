<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $id = $request->input('id');
        $cart[$id] = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'quantity' => ($cart[$id]['quantity'] ?? 0) + 1,
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produkt dodany do koszyka.');
    }
}
