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
             class="impact-card group p-6 rounded-xl bg-gray-50 dark:bg-ca-secondary transition-all duration-300 hover:bg-ca-highlight/10 dark:hover:bg-ca-highlight/20">
          <div class="w-12 h-12 mb-4 text-ca-primary dark:text-ca-highlight">
            <!-- Dynamic Icons -->
            @if($metric['icon'] == 'users')
              <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 14.016q2.531 0 5.273 1.102t2.742 2.883v2.016h-16v-2.016q0-1.781 2.742-2.883t5.273-1.102zM12 12q-1.641 0-2.813-1.172t-1.172-2.813 1.172-2.836 2.813-1.195 2.813 1.195 1.172 2.836-1.172 2.813-2.813 1.172z"/>
              </svg>
            @endif
            <!-- Add more icon conditions -->
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
