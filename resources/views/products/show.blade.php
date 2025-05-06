@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
        <p class="text-gray-500 mb-2">Producent: {{ $product->manufacturer }}</p>
        <p class="mb-4">Kod produktu: {{ $product->product_code }}</p>
        <p class="font-bold text-xl text-blue-600 mb-4">
            Cena: {{ number_format($product->sale_price_brutto, 2) }} zł
        </p>

        {{-- Форма добавления в корзину --}}
        <form method="POST" action="{{ route('cart.add') }}" class="mb-6">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Dodaj do koszyka
            </button>
        </form>
<form method="POST" action="{{ route('favorites.add') }}" class="inline-block ml-4">
    @csrf
    <input type="hidden" name="id" value="{{ $product->id }}">
    <input type="hidden" name="name" value="{{ $product->name }}">
    <input type="hidden" name="price" value="{{ $product->sale_price_brutto }}">
    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
        Dodaj do ulubionych
    </button>
</form>


        {{-- Альтернативно Livewire-компонент (если используешь Livewire) --}}
        {{-- @livewire('add-to-cart', [
            'productId' => $product->id,
            'name' => $product->name,
            'price' => $product->price
        ]) --}}

        <div class="mb-4">
            <h2 class="font-semibold">Specyfikacja</h2>
            <p>{{ $product->specification }}</p>
        </div>

        <div class="mb-4">
            <h2 class="font-semibold">Zastosowanie</h2>
            <p>{{ $product->usage }}</p>
        </div>

        <div class="mb-4">
            <h2 class="font-semibold">Zamienniki</h2>
            <p>{{ $product->replacements }}</p>
        </div>

        <div class="mb-4">
            <h2 class="font-semibold">Kody OE</h2>
            <p>{{ $product->oe_codes }}</p>
        </div>

        <a href="{{ route('products.index') }}" class="inline-block mt-6 text-blue-500 hover:underline">
            ← Powrót do listy produktów
        </a>
    </div>
@endsection
