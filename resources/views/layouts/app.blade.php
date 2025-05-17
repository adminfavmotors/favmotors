<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', config('app.name') . ' — części samochodowe')</title>
  <meta name="description" content="@yield('meta_description', 'FAVMOTORS — najlepszy sklep z częściami samochodowymi w Polsce')">
  <meta name="keywords" content="@yield('meta_keywords', 'części samochodowe, FAVMOTORS, sklep online')">

  <!-- Vite: CSS & JS -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles

  @stack('head')
</head>
<body class="font-sans antialiased bg-gray-100">

  @include('partials.header')

  <main class="pt-2"
    @yield('content')
  </main>

  @include('partials.footer')

  @livewireScripts
  @stack('scripts')
</body>
</html>

