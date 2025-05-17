<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::latest()->get();

        return view('products.index', compact('products'));
    }

    // Используем имплицитную привязку модели по slug
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
