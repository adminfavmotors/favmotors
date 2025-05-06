<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Сделать переменную $cart доступной глобально в представлениях
        View::composer('*', function ($view) {
            $cart = session()->get('cart', []);
            $total = collect($cart)->reduce(function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0);

            $view->with('cart', $cart)->with('total', $total);
        });
    }
}
