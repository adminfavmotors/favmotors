@extends('layouts.app')

@section('title', 'Koszyk')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Twój koszyk</h1>

        @if(session('cart') && count(session('cart')) > 0)
            <table class="w-full text-left mb-4">
                <thead>
                    <tr>
                        <th class="border-b p-2">Produkt</th>
                        <th class="border-b p-2">Cena</th>
                        <th class="border-b p-2">Ilość</th>
                        <th class="border-b p-2">Suma</th>
                        <th class="border-b p-2">Akcja</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach(session('cart') as $id => $item)
                        @php $total += $item['price'] * $item['quantity']; @endphp
                        <tr>
                            <td class="border-b p-2">{{ $item['name'] }}</td>
                            <td class="border-b p-2">{{ number_format($item['price'], 2) }} zł</td>
                            <td class="border-b p-2">{{ $item['quantity'] }}</td>
                            <td class="border-b p-2">{{ number_format($item['price'] * $item['quantity'], 2) }} zł</td>
                            <td class="border-b p-2">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Usuń</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right font-bold">
                Łącznie: {{ number_format($total, 2) }} zł
            </div>
        @else
            <p>Twój koszyk jest pusty.</p>
        @endif
    </div>
@endsection
