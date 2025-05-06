@extends('layouts.app')

@section('title', 'Ulubione')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Ulubione produkty</h1>

        @if (count($favorites) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($favorites as $item)
                    <div class="border p-4 rounded shadow">
                        <h2 class="text-lg font-semibold">{{ $item['name'] }}</h2>
                        <p class="text-gray-700">Cena: {{ number_format($item['price'], 2) }} zł</p>
                        <form method="POST" action="{{ route('favorites.remove') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                            <button class="mt-2 bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Usuń z ulubionych
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <p>Nie masz jeszcze żadnych ulubionych produktów.</p>
        @endif
    </div>
@endsection
