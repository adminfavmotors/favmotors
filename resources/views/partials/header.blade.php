<header class="bg-white shadow fixed top-0 left-0 w-full z-50 py-4 px-6 flex items-center justify-between">
    <!-- Логотип -->
    <div class="text-2xl md:text-3xl font-extrabold text-blue-800 tracking-wide">
        <a href="{{ route('home') }}">FAVMOTORS</a>
    </div>

    <!-- Навигация и Поиск -->
    <div class="flex items-center flex-1 mx-4 space-x-4">
        <!-- Каталог (выпадающее меню) -->
<div class="relative inline-block group">
  <button class="text-gray-700 font-semibold hover:text-blue-600 focus:outline-none">
    Katalog
  </button>

  <div
    class="absolute left-0 mt-2 w-56 bg-white border border-gray-200 rounded shadow-lg
           opacity-0 invisible
           group-hover:opacity-100 group-hover:visible
           pointer-events-none group-hover:pointer-events-auto
           transition-all duration-200
           z-50"
  >
    <ul class="py-2">
      <li><a href="{{ route('category.show', 'filtry') }}" class="block px-4 py-2 hover:bg-gray-100">Filtry</a></li>
      <li><a href="{{ route('category.show', 'uklad-hamulcowy') }}" class="block px-4 py-2 hover:bg-gray-100">Układ hamulcowy</a></li>
      <li><a href="{{ route('category.show', 'oswietlenie') }}" class="block px-4 py-2 hover:bg-gray-100">Oświetlenie</a></li>
      <li><a href="{{ route('category.show', 'zawieszenie') }}" class="block px-4 py-2 hover:bg-gray-100">Zawieszenie</a></li>
    </ul>
  </div>
</div>


        <!-- Строка поиска -->
        <form action="{{ route('products.index') }}" method="GET" class="flex-grow max-w-md">
            <input type="text" name="q" placeholder="Szukaj części..."
                   class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-300 transition">
        </form>
    </div>

    <!-- Иконки -->
    <div class="flex items-center space-x-5 text-gray-700 text-xl">
        <!-- Избранное -->
        <a href="{{ route('favorites.index') }}" title="Ulubione"
           class="hover:text-red-500 transition duration-200 transform hover:scale-110">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 md:h-8 md:w-8" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                      clip-rule="evenodd" />
            </svg>
        </a>

        <!-- Профиль -->
        <a href="{{ route('profile.edit') }}" title="Profil"
           class="hover:text-blue-500 transition duration-200 transform hover:scale-110">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 14c3.866 0 7 3.134 7 7H5c0-3.866 3.134-7 7-7zM12 12a5 5 0 100-10 5 5 0 000 10z" />
            </svg>
        </a>

        <!-- Корзина -->
        @livewire('cart-dropdown')
    </div>
</header>

<div class="h-16"></div>
<nav class="bg-white border-b shadow-sm">
    <div class="container mx-auto px-6">
        <ul class="flex justify-center space-x-6 text-gray-700 text-lg md:text-xl font-extrabold">
            <li>
                <a href="{{ route('category.show', 'oleje-i-plyny') }}"
                   class="block py-2 hover:text-blue-600 transition">
                    Oleje i płyny
                </a>
            </li>
            <li>
                <a href="{{ route('category.show', 'chemia-i-detailing') }}"
                   class="block py-2 hover:text-blue-600 transition">
                    Chemia i detailing
                </a>
            </li>
            <li>
                <a href="{{ route('category.show', 'akcesoria-samochodowe') }}"
                   class="block py-2 hover:text-blue-600 transition">
                    Akcesoria
                </a>
            </li>
            <li>
                <a href="{{ route('category.show', 'akumulatory') }}"
                   class="block py-2 hover:text-blue-600 transition">
                    Akumulatory
                </a>
            </li>
            <li>
                <a href="{{ route('category.show', 'opony') }}"
                   class="block py-2 hover:text-blue-600 transition">
                    Opony
                </a>
            </li>
        </ul>
    </div>
</nav>
