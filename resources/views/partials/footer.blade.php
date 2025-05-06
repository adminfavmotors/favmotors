{{-- resources/views/partials/footer.blade.php --}}
<footer class="bg-gray-900 text-gray-300 pt-12">
  <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">

    {{-- Левая колонка --}}
    <div class="space-y-2 text-sm">
      <h5 class="text-white font-semibold mb-4">Informacje</h5>
      <ul class="space-y-1">
        <li><a href="#" class="hover:underline">Zwroty towaru</a></li>
        <li><a href="#" class="hover:underline">Reklamacje</a></li>
        <li><a href="#" class="hover:underline">Dostawa</a></li>
        <li><a href="#" class="hover:underline">Regulamin</a></li>
        <li><a href="#" class="hover:underline">Polityka prywatności</a></li>
        <li><a href="#" class="hover:underline">Ustawienia cookies</a></li>
      </ul>
    </div>

    {{-- Центральная колонка --}}
    <div class="space-y-2 text-sm text-center md:text-left">
      <h5 class="text-white font-semibold mb-4">Menu</h5>
      <ul class="space-y-1">
        <li><a href="#" class="hover:underline">O nas</a></li>
        <li><a href="#" class="hover:underline">Katalog części</a></li>
        <li><a href="#" class="hover:underline">Nowości</a></li>
        <li><a href="#" class="hover:underline">Promocje</a></li>
        <li><a href="#" class="hover:underline">Kontakt</a></li>
      </ul>
    </div>

    {{-- Правая колонка --}}
    <div class="space-y-4 text-sm text-center md:text-right">
      <h5 class="text-white font-semibold mb-4">Kontakt</h5>
      <p>
        <a href="mailto:admin@favmotors.com" class="hover:underline">admin@favmotors.com</a><br>
        <a href="tel:+48788554887" class="hover:underline">+48 788 554 887</a><br>
        ul. Podmiłów 4B<br>
        30-829 Kraków
      </p>
      <div class="flex justify-center md:justify-end space-x-4 mt-2">
        <!-- Facebook -->
        <a href="#" target="_blank" rel="noopener" aria-label="Facebook" class="hover:text-white">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current" viewBox="0 0 24 24">
            <!-- вставьте свой path -->
            <path d="M22 12a10 10 0 10-11.5 9.9v-7h-2v-3h2v-2c0-2 1-3 3-3h2v3h-2c-.6 0-1 .4-1 1v1h3l-.5 3h-2.5v7A10 10 0 0022 12z"/>
          </svg>
        </a>
        <!-- Instagram -->
        <a href="#" target="_blank" rel="noopener" aria-label="Instagram" class="hover:text-white">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current" viewBox="0 0 24 24">
            <!-- вставьте свой path -->
            <path d="M7 2C4 2 2 4 2 7v10c0 3 2 5 5 5h10c3 0 5-2 5-5V7c0-3-2-5-5-5H7zm10 2a1 1 0 110 2 1 1 0 010-2zm-5 1.5A5.5 5.5 0 1116.5 11 5.5 5.5 0 0112 5.5zm0 9A3.5 3.5 0 1015.5 11 3.5 3.5 0 0012 14.5z"/>
          </svg>
        </a>
        <!-- Google -->
        <a href="#" target="_blank" rel="noopener" aria-label="Google" class="hover:text-white">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current" viewBox="0 0 48 48">
            <!-- вставьте свои path -->
            <path fill="#EA4335" d="M24 11.5c3.5 0 6 1.2 7.4 2.2l5.4-5.4C33 5 29 3.5 24 3.5 14.9 3.5 7.1 9.4 4 18l6.3 4.9C12.1 15.4 17.6 11.5 24 11.5z"/>
            <path fill="#4285F4" d="M46.5 24c0-1.5-.1-2.6-.4-3.7H24v7h12.7c-.5 3-2.5 6-6.3 7.5l6.3 4.9C43.8 37 46.5 30 46.5 24z"/>
            <path fill="#FBBC05" d="M10.3 28.9A14.6 14.6 0 019.5 24c0-1.9.4-3.7 1-5.3l-6.3-4.9A24 24 0 002.5 24c0 3.9 1 7.5 2.8 10.7l6.3-4.8z"/>
            <path fill="#34A853" d="M24 46.5c5.9 0 10.9-1.9 14.5-5.2l-6.9-5.4c-1.9 1.3-4.3 2.2-7.6 2.2-6.3 0-11.7-4.1-13.6-9.6l-6.3 4.8C7.1 38.6 14.9 44.5 24 44.5z"/>
            <path fill="none" d="M2 2h44v44H2z"/>
          </svg>
        </a>
      </div>
    </div>

  </div>

  <div class="border-t border-gray-700 mt-8 pt-4 text-center text-xs text-gray-500">
    © {{ now()->year }} FAVMOTORS. Wszystkie prawa zastrzeżone.
  </div>
</footer>
