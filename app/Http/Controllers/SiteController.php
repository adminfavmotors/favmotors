<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Banner;

class SiteController extends Controller
{
public function home()
{
    // получаем только активные баннеры
    $banners = Banner::where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    // получаем только активные акции
    $promotions = Promotion::where('is_active', true)
        ->orderBy('sort_order')
        ->get();
	// получаем контент страницы "O nas"
	$aboutPage = \App\Models\Page::where('slug', 'o-nas')->where('is_active', true)->first();

    // получаем страницу «O nas»
    $aboutPage = \App\Models\Page::where('slug', 'o_nas')
        ->where('is_active', true)
        ->first();

return view('home', compact('banners', 'promotions', 'aboutPage'));
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
