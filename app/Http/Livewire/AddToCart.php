<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddToCart extends Component
{
    public $productId;
    public $name;
    public $price;

    public function addToCart()
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$this->productId])) {
            $cart[$this->productId]['quantity'] += 1;
        } else {
            $cart[$this->productId] = [
                'name' => $this->name,
                'price' => $this->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        $this->dispatchBrowserEvent('cart-updated');
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
