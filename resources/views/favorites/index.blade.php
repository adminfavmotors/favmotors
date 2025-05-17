{{-- resources/views/favorites/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Ulubione — FAVMOTORS')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Twoje ulubione produkty</h1>

    @if($favorites)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($favorites as $id => $item)
                <div class="border p-4 rounded shadow">
                    <h2 class="text-lg font-semibold">{{ $item['name'] }}</h2>
                    <p class="text-gray-700">Cena: {{ number_format($item['price'], 2) }} zł</p>
                    <form method="POST" action="{{ route('favorites.remove', $id) }}">
                        @csrf
                        @method('DELETE')
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
