@extends('layouts.app')

@section('content')

<livewire:hero-slider />

<x-category-menu :categories="$categories" />

<!-- Hero Section -->
<section class="hero">
  <div class="text-center">
    <h1 class="display-4 fw-bold">Części samochodowe do każdej marki</h1>
    <p class="lead">Szybko. Tanio. Pewnie.</p>
  </div>
</section>

<!-- Search Bar -->
<section class="py-5 bg-light">
  <div class="container">
    <form class="row g-3">
      <!-- ... остальной HTML ... -->
    </form>
  </div>
</section>

<!-- Featured Brands -->
<section class="py-4 text-center">
  <div class="container">
    <h2 class="mb-4">Popularne marki</h2>
    <div class="brand-logos d-flex justify-content-center flex-wrap">
      <!-- ... логотипы ... -->
    </div>
  </div>
</section>

{{-- Акции --}}
@if($promotions->isEmpty())
  <p class="text-center py-4">Нет активных акций</p>
@else
  <div class="mt-6 px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    @foreach($promotions as $promotion)
      <x-promo-card
        :background="$promotion->background"
        :url="route('promotions.show', $promotion->slug)"
        :show-overlay="false"
      />
    @endforeach
  </div>
@endif

{{-- Раздел «O nas», отделённый от акций --}}
<hr class="my-8 border-gray-300">

@if(! empty($aboutPage))
  <section id="o-nas" class="prose mx-auto mb-12">
    <h2>O nas</h2>
    {!! $aboutPage->content !!}
  </section>
@endif

@endsection
