@extends('layouts.app')

@section('content')
  <div class="container mx-auto px-6 py-8">
    {{-- Заголовок акции --}}
    <h1 class="text-3xl font-bold mb-4">{{ $promotion->title }}</h1>

    @if($promotion->display_mode === 'grid')
        {{-- Сетка товаров --}}
        <livewire:promotion-products-grid :slug="$promotion->slug" />
    @else
        {{-- Текстовый режим — выводим HTML из редактора --}}
        <div class="prose max-w-none mb-6">
            {!! $promotion->subtext !!}
        </div>
    @endif
  </div>
@endsection
