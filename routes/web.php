<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FavoriteController;


// …

Route::get('/produkty', [ProductController::class, 'index'])->name('products.index');
Route::get('/ulubione', [FavoriteController::class, 'index'])->name('favorites.index');

// Главная страница — теперь всегда FAVMOTORS
Route::get('/', [SiteController::class, 'home'])->name('home');

// Перенаправление на главную после входа
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth'])->name('dashboard');

// Защищённые маршруты профиля
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/katalog/{slug}', [CategoryController::class, 'show'])->name('category.show');

require __DIR__.'/auth.php';
