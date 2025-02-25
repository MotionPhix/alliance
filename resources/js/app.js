import './bootstrap';
import Swiper from 'swiper';
import 'swiper/swiper-bundle.css';
import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

const swiper = new Swiper('.swiper-container', {
  loop: true,
  speed: 1000,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  autoplay: {
    delay: 5000,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  effect: 'fade',
  fadeEffect: {
    crossFade: true
  },
});
