<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    // Список всех активных акций (если понадобится)
    public function index()
    {
        $promotions = Promotion::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('promotions.index', compact('promotions'));
    }

    // Страница конкретной акции по её slug
    public function show($slug)
    {
        $promotion = Promotion::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('promotions.show', compact('promotion'));
    }
}
