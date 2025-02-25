@props(['testimonials'])

<section class="py-16 bg-gray-50 dark:bg-ca-secondary">
  <x-content-container>
    <h2 class="text-3xl font-bold text-center mb-12 text-ca-primary dark:text-ca-highlight">
      What People Say About Us
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($testimonials as $testimonial)
        <div class="bg-white dark:bg-ca-primary p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
          <div class="flex items-center mb-4">
            <img src="{{ asset($testimonial['image']) }}"
                 alt="{{ $testimonial['name'] }}"
                 class="w-12 h-12 rounded-full object-cover">
            <div class="ml-4">
              <h3 class="text-lg font-semibold text-ca-primary dark:text-white">
                {{ $testimonial['name'] }}
              </h3>
              <p class="text-sm text-gray-500 dark:text-gray-300">
                {{ $testimonial['role'] }}
              </p>
            </div>
          </div>
          <p class="text-gray-600 dark:text-gray-300">
            "{{ $testimonial['quote'] }}"
          </p>
        </div>
      @endforeach
    </div>
  </x-content-container>
</section>
