<div class="relative h-[600px] overflow-hidden">
  <div class="swiper-container h-full">
    <div class="swiper-wrapper">
      <!-- Slide 1 -->
      <div class="swiper-slide relative">
        <img src="{{ asset('images/hero-1.jpg') }}" alt="Community Empowerment" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50 flex items-center">
          <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-6xl font-bold text-white mb-6 animate-fade-in-up">
              Building Sustainable Communities
            </h2>
            <p class="text-xl text-white mb-8 max-w-2xl mx-auto animate-fade-in-up delay-100">
              Empowering local communities through education and sustainable development initiatives
            </p>
            <a href="/programs"
               class="inline-block bg-ca-amber text-ca-blue px-8 py-3 rounded-lg font-semibold
                                  hover:bg-ca-purple hover:text-white transition-transform transform hover:scale-105">
              Explore Our Programs
            </a>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="swiper-slide relative">
        <img src="{{ asset('images/hero-2.jpg') }}" alt="Education Initiative" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50 flex items-center">
          <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-6xl font-bold text-white mb-6 animate-fade-in-up">
              Transforming Lives Through Education
            </h2>
            <p class="text-xl text-white mb-8 max-w-2xl mx-auto animate-fade-in-up delay-100">
              Providing access to quality education for underserved communities
            </p>
            <a href="/get-involved"
               class="inline-block bg-ca-red text-white px-8 py-3 rounded-lg font-semibold
                                  hover:bg-ca-green hover:text-white transition-transform transform hover:scale-105">
              Support Our Cause
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation -->
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</div>
