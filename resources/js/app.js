import './bootstrap';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

// функция инициализации слайдера
function initSwiper() {
  const container = document.querySelector('.swiper-container');
  if (!container) return;

  new Swiper(container, {
    slidesPerView: 1,      // показываем по одному слайду
    spaceBetween: 0,       // без отступов между слайдами
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
}

// первый запуск
document.addEventListener('DOMContentLoaded', initSwiper);

// после каждого рендера Livewire
document.addEventListener('livewire:load', () => {
  initSwiper();
  if (window.Livewire) {
    window.Livewire.hook('message.processed', initSwiper);
  }
});
