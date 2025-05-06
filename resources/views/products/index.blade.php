@extends('layouts.app')

@section('title', 'Produkty')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Nasze produkty</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
            <div class="bg-white rounded shadow p-4">
                <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                <p class="text-gray-600 text-sm mb-2">{{ $product->manufacturer }}</p>
                <p class="font-bold text-blue-600">Cena: {{ number_format($product->sale_price_brutto, 2) }} zł</p>
                <a href="{{ route('products.show', $product->slug) }}" class="inline-block mt-3 text-blue-500 hover:underline">
    Szczegóły
</a>

            </div>
        @endforeach
    </div>
@endsection
