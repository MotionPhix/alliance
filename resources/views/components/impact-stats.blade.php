@props(['metrics'])

<section class="py-16 bg-white dark:bg-ca-primary">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-center mb-12 text-ca-primary dark:text-ca-highlight">
      Our Impact in Numbers
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      @foreach($metrics as $metric)
        <div x-data="{ count: 0, target: {{ (int) str_replace(',', '', $metric['metric']) }}, duration: 2000 }"
             x-init="() => {
                         const increment = target / (duration / 16);
                         const updateCount = () => {
                             if (count < target) {
                                 count = Math.ceil(count + increment);
                                 if (count > target) count = target;
                                 $refs.count.textContent = count.toLocaleString();
                                 requestAnimationFrame(updateCount);
                             }
                         };
                         updateCount();
                     }"
             class="impact-card group p-6 rounded-xl bg-gray-50 dark:bg-ca-secondary transition-all duration-300 hover:bg-ca-highlight/10 dark:hover:bg-ca-highlight/20 hover:shadow-xl">
          <div class="w-12 h-12 mb-4 text-ca-primary dark:text-ca-highlight transform group-hover:scale-110 transition-transform duration-300">
            <!-- Dynamic Icons -->
            @if($metric['icon'] == 'users')
              <x-heroicon-o-users class="w-full h-full" />
            @elseif($metric['icon'] == 'school')
              <x-heroicon-o-academic-cap class="w-full h-full" />
            @elseif($metric['icon'] == 'medical')
              <x-carbon-military-camp class="w-full h-full" />
            @elseif($metric['icon'] == 'training')
              <x-carbon-course class="w-full h-full" />
            @elseif($metric['icon'] == 'women')
              <x-mdi-human-female class="w-full h-full" />
            @else
              <x-carbon-rain-drop class="w-full h-full" />
            @endif
          </div>

          <div class="text-4xl font-bold mb-2 text-ca-primary dark:text-white">
            <span x-ref="count">0</span>+
          </div>

          <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-gray-200">
            {{ $metric['title'] }}
          </h3>
          <p class="text-gray-600 dark:text-gray-300">
            {{ $metric['description'] }}
          </p>
        </div>
      @endforeach
    </div>
  </div>
</section>
