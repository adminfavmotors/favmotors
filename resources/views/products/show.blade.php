@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white rounded shadow p-6">
        {{-- Название товара --}}
        <h1 class="text-2xl font-bold mb-4">{{ $product->name }}</h1>

        {{-- Базовая информация --}}
        <p class="mb-2"><strong>Part Number:</strong> {{ $product->slug }}</p>
        <p class="mb-2"><strong>Manufacturer:</strong> {{ optional($product->manufacturer)->name }}</p>
        <p class="mb-2"><strong>Category:</strong> {{ optional($product->category)->name }}</p>
        <p class="mb-2"><strong>Price Netto:</strong> {{ number_format($product->sale_price_netto, 2, ',', ' ') }} zł</p>
        <p class="mb-2"><strong>Price Brutto:</strong> {{ number_format($product->sale_price_brutto, 2, ',', ' ') }} zł</p>

        {{-- Описание --}}
        @if($product->description)
            <div class="mt-4 prose">
                {!! nl2br(e($product->description)) !!}
            </div>
        @endif

        {{-- Характеристики (usage) --}}
        @if(! empty($product->usage))
            <div class="mt-4">
                <h2 class="text-xl font-semibold">Характеристики</h2>
                <ul class="list-disc list-inside">
                    @foreach($product->usage as $key => $value)
                        <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Кроссы --}}
        @if(! empty($product->crosses))
            <div class="mt-4">
                <h2 class="text-xl font-semibold">Кроссы</h2>
                <ul class="list-disc list-inside">
                    @foreach($product->crosses as $cross)
                        <li>
                            <a href="{{ route('products.show', ['product' => $cross]) }}" class="underline">
                                {{ $cross }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Кнопка назад --}}
        <div class="mt-6">
            <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline">&larr; Назад</a>
        </div>
    </div>
</div>
@endsection
