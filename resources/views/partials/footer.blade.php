{{-- resources/views/partials/footer.blade.php --}}
<footer class="bg-gray-900 text-gray-300 pt-12">
  <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">

    {{-- Левая колонка: Информация из админки --}}
    <div class="space-y-2 text-sm">
      <h5 class="text-white font-semibold mb-4">Informacje</h5>
      @php
        use App\Models\Page;
        $infoPages = Page::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
      @endphp
      <ul class="space-y-1">
        @foreach($infoPages as $page)
          <li>
            <a href="{{ route('pages.show', $page->slug) }}" class="hover:underline">
              {{ $page->title }}
            </a>
          </li>
        @endforeach
      </ul>
    </div>

    {{-- Центральная колонка: Меню --}}
    <div class="space-y-2 text-sm text-center md:text-left">
      <h5 class="text-white font-semibold mb-4">Menu</h5>
	<ul class="space-y-1">
	  <li><a href="{{ route('home') }}" class="hover:underline">Strona główna</a></li>
	  <li><a href="{{ route('category.show', 'oleje-i-plyny') }}" class="hover:underline">Oleje i płyny</a></li>
	  <li><a href="{{ route('category.show', 'chemia-i-detailing') }}" class="hover:underline">Chemia i detailing</a></li>
	  <li><a href="{{ route('pages.show', 'promocje') }}" class="hover:underline">Promocje</a></li>
	  <li><a href="{{ route('pages.show', 'kontakt') }}" class="hover:underline">Kontakt</a></li>
	</ul>
    </div>

    {{-- Правая колонка: Контакты и соцсети --}}
    <div class="space-y-4 text-sm text-center md:text-right">
      <h5 class="text-white font-semibold mb-4">Kontakt</h5>
      <p>
        <a href="mailto:admin@favmotors.com" class="hover:underline">admin@favmotors.com</a><br>
        <a href="tel:+48788554887" class="hover:underline">+48 788 554 887</a><br>
        ul. Podmiłów 4B<br>
        30-829 Kraków
      </p>
      <div class="flex justify-center md:justify-end space-x-4 mt-2">
        <!-- Иконки соцсетей (Facebook, Instagram, Google) -->
        <!-- ... SVG как в исходном коде ... -->
      </div>
    </div>

  </div>

  <div class="border-t border-gray-700 mt-8 pt-4 text-center text-xs text-gray-500">
    © {{ now()->year }} FAVMOTORS. Wszystkie prawa zastrzeżone.
  </div>
</footer>
