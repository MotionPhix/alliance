@props(['programs'])

<section class="py-16 dark:bg-ca-secondary">
  <h2 class="text-3xl font-bold text-center mb-12 text-ca-primary dark:text-ca-highlight">
    Our Core Programs
  </h2>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    @foreach($programs as $program)
      <div class="program-card group p-6 rounded-xl bg-white dark:bg-ca-primary shadow-lg hover:shadow-xl transition-all duration-300">
        <div class="w-12 h-12 mb-4 text-ca-primary dark:text-ca-highlight">
          <!-- Program Icon -->
          @if($program->icon == 'scorecard')
            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
          @elseif($program->icon == 'youth')
            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
          @endif
        </div>
        <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-gray-200">
          {{ $program->title }}
        </h3>
        <p class="text-gray-600 dark:text-gray-300 mb-4">
          {{ $program->description }}
        </p>
        <a href="{{ route('programs.show', $program->slug) }}"
           class="text-ca-amber font-semibold hover:text-ca-purple dark:hover:text-ca-highlight">
          Learn More →
        </a>
      </div>
    @endforeach
  </div>
</section>
