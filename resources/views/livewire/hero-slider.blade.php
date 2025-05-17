{{-- resources/views/livewire/hero-slider.blade.php --}}
<div class="relative w-full overflow-hidden">
  <div class="swiper-container w-full h-48 md:h-64 lg:h-80 overflow-hidden">
    <div class="swiper-wrapper">
      @foreach($banners as $banner)
        <div class="swiper-slide h-full">
          <a href="{{ $banner['link'] }}" class="block w-full h-full">
            <img
              src="{{ asset('storage/' . $banner['image']) }}"
              alt="{{ $banner['title'] }}"
              class="w-full h-full object-cover object-center"
            >
          </a>
        </div>
      @endforeach
    </div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>
</div>
