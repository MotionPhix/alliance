import './bootstrap';
import Swiper from 'swiper';
import 'swiper/swiper-bundle.css';
import Alpine from 'alpinejs'
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

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

gsap.registerPlugin(ScrollTrigger);

// Animate elements on scroll
gsap.utils.toArray('.animate-on-scroll').forEach(element => {
  gsap.from(element, {
    opacity: 0,
    y: 50,
    duration: 1,
    scrollTrigger: {
      trigger: element,
      start: 'top 80%',
    },
  });
});
