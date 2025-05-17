@extends('layouts.app')

@section('title', 'Koszyk — FAVMOTORS')

@section('content')
  <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Twój koszyk</h1>

    @if($cart)
      <table class="w-full mb-6">
        <thead>
          <tr class="text-left">
            <th>Produkt</th>
            <th>Ilość</th>
            <th>Cena</th>
            <th>Razem</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($cart as $id => $item)
            <tr>
              <td>{{ $item['name'] }}</td>
              <td>{{ $item['quantity'] }}</td>
              <td>{{ number_format($item['price'], 2) }} zł</td>
              <td>{{ number_format($item['price'] * $item['quantity'], 2) }} zł</td>
              <td>
                <form action="{{ route('cart.remove', $id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="text-red-500 hover:underline">Usuń</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="text-right font-bold text-xl">
        Suma: {{ number_format($total, 2) }} zł
      </div>
    @else
      <p>Twój koszyk jest pusty.</p>
    @endif
  </div>
@endsection
