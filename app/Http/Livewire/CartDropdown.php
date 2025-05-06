<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartDropdown extends Component
{
    public $cart = [];
    public $total = 0;

    public function mount()
    {
        $this->cart = session()->get('cart', []);
        $this->total = collect($this->cart)->reduce(function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    }

    public function render()
    {
        return view('livewire.cart-dropdown', [
            'cart' => $this->cart,
            'total' => $this->total,
        ]);
    }
}

