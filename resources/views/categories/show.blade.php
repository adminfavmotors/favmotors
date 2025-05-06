@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="flex flex-col md:flex-row gap-6">
    <!-- Sidebar: фильтры -->
    <aside class="md:w-1/4 w-full bg-white p-4 rounded shadow">
        <h2 class="text-lg font-bold mb-4">Filtry</h2>

        <form method="GET" action="{{ route('category.show', $category->slug) }}">
            <!-- Производитель -->
            <div class="mb-4">
                <h3 class="font-semibold mb-2">Producent</h3>
                @foreach($manufacturers as $manufacturer)
                    <label class="block text-sm">
                        <input type="checkbox" name="manufacturer[]" value="{{ $manufacturer }}"
                            {{ in_array($manufacturer, request()->get('manufacturer', [])) ? 'checked' : '' }}>
                        {{ $manufacturer }}
                    </label>
                @endforeach
            </div>

            <!-- Тип -->
            <div class="mb-4">
                <h3 class="font-semibold mb-2">Typ</h3>
                @foreach($types as $type)
                    <label class="block text-sm">
                        <input type="checkbox" name="type[]" value="{{ $type }}"
                            {{ in_array($type, request()->get('type', [])) ? 'checked' : '' }}>
                        {{ $type }}
                    </label>
                @endforeach
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-2">
                Zastosuj filtry
            </button>
        </form>
    </aside>

    <!-- Список товаров -->
    <main class="md:w-3/4 w-full">
        <h1 class="text-2xl font-bold mb-6">{{ $category->name }}</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($products as $product)
                <div class="border rounded p-4 bg-white shadow hover:shadow-md transition">
                    <h2 class="font-bold text-lg mb-2">{{ $product->name }}</h2>
                    <p class="text-sm text-gray-600">Producent: {{ $product->manufacturer }}</p>
                    <p class="text-sm text-gray-600">Typ: {{ $product->type }}</p>
                    <p class="mt-2 font-bold text-blue-600">{{ number_format($product->price, 2) }} zł</p>
                </div>
            @empty
                <p>Brak produktów w tej kategorii.</p>
            @endforelse
        </div>
    </main>
</div>
@endsection
