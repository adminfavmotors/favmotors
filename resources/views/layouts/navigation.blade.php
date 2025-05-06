<header class="bg-white shadow fixed top-0 left-0 w-full z-50 py-4 px-6 flex items-center justify-between">
    <div class="text-3xl font-extrabold text-blue-800 tracking-wide">
        <a href="{{ route('home') }}">FAVMOTORS</a>
    </div>

    <div class="flex items-center space-x-4 flex-1 mx-6">
        <!-- Katalog (menu rozwijane) -->
        <div class="relative group">
            <button class="text-gray-700 font-semibold hover:text-blue-600">Katalog</button>
            <div class="absolute left-0 mt-2 w-56 bg-white border border-gray-200 rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                <ul class="py-2">
                    <li><a href="{{ route('category.show', 'filtry') }}" class="block px-4 py-2 hover:bg-gray-100">Filtry</a></li>
                    <li><a href="{{ route('category.show', 'uklad-hamulcowy') }}" class="block px-4 py-2 hover:bg-gray-100">Układ hamulcowy</a></li>
                    <li><a href="{{ route('category.show', 'oswietlenie') }}" class="block px-4 py-2 hover:bg-gray-100">Oświetlenie</a></li>
                    <li><a href="{{ route('category.show', 'zawieszenie') }}" class="block px-4 py-2 hover:bg-gray-100">Zawieszenie</a></li>
                </ul>
            </div>
        </div>

        <!-- Wyszukiwarka -->
        <form action="#" method="GET" class="flex-grow">
            <input type="text" name="q" placeholder="Szukaj części..." class="w-3/4 border rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-300">
        </form>
    </div>

    <!-- Ikony -->
    <div class="flex items-center space-x-5 text-gray-700 text-xl">
        <a href="{{ route('favorites.index') }}" title="Ulubione"
           class="hover:text-red-500 transition duration-200 transform hover:scale-110">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                      clip-rule="evenodd" />
            </svg>
        </a>

        <a href="#" title="Profil" class="hover:text-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 14c3.866 0 7 3.134 7 7H5c0-3.866 3.134-7 7-7zM12 12a5 5 0 100-10 5 5 0 000 10z" />
            </svg>
        </a>

        @livewire('cart-dropdown')
    </div>
</header>

<!-- Spacer pod nagłówkiem -->
<div class="h-20"></div>
