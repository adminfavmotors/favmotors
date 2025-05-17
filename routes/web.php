<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\PageController;

// Товары
Route::get('/produkty', [ProductController::class, 'index'])->name('products.index');
Route::get('/produkty/{product:slug}', [ProductController::class, 'show'])->name('products.show');

// Корзина
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
// Удаление из корзины
Route::delete('/cart/{id}/remove', [CartController::class, 'remove'])
     ->name('cart.remove');

// Избранное
Route::post('/favorites/add', [FavoriteController::class, 'add'])->name('favorites.add');
Route::delete('/favorites/{id}/remove', [FavoriteController::class, 'remove'])->name('favorites.remove');
Route::get('/ulubione', [FavoriteController::class, 'index'])->name('favorites.index');

// Главная
Route::get('/', [SiteController::class, 'home'])->name('home');

// Перенаправление после логина
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth'])->name('dashboard');

// Профиль
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Категории
Route::get('/katalog/{slug}', [CategoryController::class, 'show'])->name('category.show');

require __DIR__.'/auth.php';

Route::get('/promotions', [PromotionController::class, 'index'])
    ->name('promotions.index');

Route::get('/promotions/{slug}', [PromotionController::class, 'show'])
     ->name('promotions.show');
// Динамический маршрут для любых информационных страниц
Route::get('/{slug}', [PageController::class, 'show'])
    ->where('slug', '[a-z0-9_-]+')
    ->name('pages.show');
