<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Banner;

class SiteController extends Controller
{
    public function home()
    {
        // Получаем только активные баннеры
        $banners = \App\Models\Banner::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Получаем только активные акции
        $promotions = \App\Models\Promotion::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Получаем страницу «O nas»
        $aboutPage = \App\Models\Page::where('slug', 'o_nas')
            ->where('is_active', true)
            ->first();

        // Получаем категории (главные + потомки)
        $categories = \App\Models\Category::with('children')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('home', [
            'banners'    => $banners,
            'promotions' => $promotions,
            'aboutPage'  => $aboutPage,
            'categories' => $categories,
        ]);
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
