<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Регистрируем Livewire-компонент hero-slider
        Livewire::component('hero-slider', \App\Http\Livewire\HeroSlider::class);

        // Делаем переменную $cart доступной во всех представлениях
        View::composer('*', function ($view) {
            $cart = session()->get('cart', []);
            $total = collect($cart)->reduce(function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0);

            $view->with('cart', $cart)->with('total', $total);
        });
    }
}
