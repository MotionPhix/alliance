import './bootstrap';
import Swiper from 'swiper';
import 'swiper/swiper-bundle.css';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import 'leaflet/dist/leaflet.css';
import 'leaflet.fullscreen/Control.FullScreen.css';

import {createApp} from 'vue';
import {ZiggyVue} from 'ziggy-js';
import L from 'leaflet';
import 'leaflet.fullscreen';

import LikeButton from './components/LikeButton.vue'
import BlogPostHeader from "@/components/BlogPostHeader.vue";
import Comments from "@/components/Comments.vue";
import ToastMessages from "@/components/ToastMessages.vue";
import BlogPostContent from "@/components/BlogPostContent.vue";

// Fix Leaflet's icon path issues with Webpack
delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
  iconRetinaUrl: '/vendor/leaflet/images/marker-icon-2x.png',
  iconUrl: '/vendor/leaflet/images/marker-icon.png',
  shadowUrl: '/vendor/leaflet/images/marker-shadow.png',
});

// Create a global map initialization function
window.initContactMap = function() {
  const map = L.map('map', {
    fullscreenControl: true,
    fullscreenControlOptions: {
      position: 'topleft',
      title: 'View Fullscreen',
      titleCancel: 'Exit Fullscreen'
    }
  }).setView([-13.987654, 33.774123], 15);

  // Add OpenStreetMap tiles
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  // Add office marker
  const office = L.marker([-13.987654, 33.774123])
    .bindPopup(`
      <div class="text-center">
        <h3 class="font-bold mb-2">Citizen Alliance</h3>
        <p class="text-sm">Area 47/2/113, Lilongwe Street</p>
        <p class="text-sm">P.O. Box 619</p>
        <p class="text-sm">Lilongwe, Malawi</p>
        <a href="https://www.google.com/maps/dir/?api=1&destination=-13.987654,33.774123"
           class="text-blue-500 hover:text-blue-700 text-sm block mt-2"
           target="_blank">
          Get Directions
        </a>
      </div>
    `, {
      maxWidth: 300
    })
    .addTo(map);

  L.control.scale().addTo(map);

  // Custom "Center Map" control
  const customControl = L.Control.extend({
    options: { position: 'topleft' },
    onAdd: function() {
      const container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
      container.innerHTML = `
        <a href="#" class="flex items-center justify-center w-10 h-10 bg-white text-gray-700 hover:bg-gray-100"
           title="Center map on office">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
        </a>
      `;

      container.onclick = function() {
        map.setView([-13.987654, 33.774123], 15);
        return false;
      };

      return container;
    }
  });

  map.addControl(new customControl());

  // Handle window resize
  window.addEventListener('resize', () => {
    map.invalidateSize();
  });

  return map;
};

// Swiper initialization
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

// GSAP animations
gsap.registerPlugin(ScrollTrigger);

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

const app = createApp({});

app
  .use(ZiggyVue)
  .component('like-button', LikeButton)
  .component('blog-post-header', BlogPostHeader)
  .component('blog-post-content', BlogPostContent)
  .component('toast-messages', ToastMessages)
  .component('comments', Comments)
  .mount('#blog_app')
