@props([
  'background',
  'url',
  'headline'     => null,
  'subtext'      => null,
  'showOverlay'  => true,   {{-- по умолчанию показываем текст --}}
])

<a href="{{ $url }}" class="group block rounded-lg overflow-hidden shadow hover:shadow-lg transition h-48 md:h-56 lg:h-64">
  <div 
    class="relative w-full h-full bg-center bg-cover"
    style="background-image: url('{{ asset("storage/{$background}") }}')"
  >
@if($showOverlay)
    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-4">
      <h3 class="text-lg font-bold">{{ $headline }}</h3>
      @if($subtext)
        <p class="mt-2 text-sm">{{ $subtext }}</p>
      @endif
    </div>
   @endif
  </div>
</a>
