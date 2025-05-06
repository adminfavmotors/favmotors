<div x-data="{ open: false }" class="relative">
    <!-- Иконка корзины -->
    <button @click="open = !open" class="relative">
        🛒
        <span class="absolute top-0 right-0 bg-red-600 text-white text-xs px-1 rounded-full">
            {{ count($cart ?? []) }}
        </span>
    </button>

    <!-- Выпадающее окно -->
    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white border rounded shadow z-50">
        <div class="p-4 max-h-96 overflow-y-auto">
            <h2 class="text-lg font-bold mb-2">Koszyk</h2>

            @forelse ($cart as $item)
                <div class="border-b pb-2 mb-2">
                    <p class="font-semibold">{{ $item['name'] }}</p>
                    <p class="text-sm">Cena: {{ number_format($item['price'], 2) }} zł</p>
                    <p class="text-sm">Ilość: {{ $item['quantity'] }}</p>
                </div>
            @empty
                <p>Twój koszyk jest pusty.</p>
            @endforelse
        </div>

        <div class="p-4 border-t text-right">
            <p class="font-bold mb-2">Suma: {{ number_format($total, 2) }} zł</p>
        </div>
    </div>
</div>
