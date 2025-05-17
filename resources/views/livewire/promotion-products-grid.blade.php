@if(count($products) === 0)
    <div class="text-center py-10">
        <p class="text-lg mb-4">Brak produktów dla tej promocji.</p>
        <a href="{{ route('produkty.index') }}" class="underline">Przejdź do katalogu</a>
    </div>
@else
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($products as $product)
            <div class="border rounded p-4 flex items-center justify-center">
                <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
            </div>
        @endforeach
    </div>
@endif
