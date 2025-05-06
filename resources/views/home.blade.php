@extends('layouts.app')

@section('content')
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

<!-- Footer note to check Tailwind -->
<div class="p-6 bg-green-500 text-white text-xl font-bold">
</div>
@endsection
