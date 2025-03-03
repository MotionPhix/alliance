<x-app-layout>
  <x-slot name="title">Our Projects & Partnerships</x-slot>
  <x-slot name="description">
    Discover how Citizen Alliance collaborates with global and local partners to drive development and governance initiatives in Malawi.
  </x-slot>

  <!-- Hero Section with Parallax Effect -->
  <section class="relative h-[500px] overflow-hidden">
    <div class="absolute inset-0 w-full h-full">
      <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/50 z-10"></div>
      <img
        src="{{ asset('images/partnerships-hero.jpg') }}"
        alt="Partnerships"
        class="w-full h-full object-cover transform scale-110"
        x-data="{}"
        x-init="window.addEventListener('scroll', () => {
          const scrolled = window.pageYOffset;
          $el.style.transform = `scale(1.1) translateY(${scrolled * 0.5}px)`;
        })"
      >
    </div>
    <div class="relative z-20 h-full flex items-center">
      <div class="container mx-auto px-4">
        <div class="max-w-3xl">
          <h1 class="text-4xl md:text-6xl font-display font-bold text-white mb-6 leading-tight">
            Transforming Lives Through Partnership
          </h1>
          <p class="text-xl text-white/90 max-w-2xl">
            Join us in our mission to create lasting change and empower communities across Malawi.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section with Animation -->
  <section class="relative -mt-16 z-30">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach([
          ['number' => '50,000+', 'label' => 'People Reached', 'icon' => 'users'],
          ['number' => '32', 'label' => 'Schools Supported', 'icon' => 'academic-cap'],
          ['number' => '85', 'label' => 'Medical Camps', 'icon' => 'heart'],
          ['number' => '450+', 'label' => 'Training Sessions', 'icon' => 'academic-cap']
        ] as $stat)
          <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-all duration-300"
            x-data="{ inView: false }"
            x-intersect="inView = true"
          >
            <div class="flex items-center space-x-4">
              <div class="p-3 bg-ca-primary/10 rounded-lg">
                <x-dynamic-component
                  :component="'heroicon-o-' . $stat['icon']"
                  class="w-6 h-6 text-ca-primary"
                />
              </div>
              <div>
                <p
                  class="text-3xl font-bold text-gray-900 dark:text-white"
                  x-data="{ number: 0 }"
                  x-init="if (inView) {
                    $nextTick(() => {
                      const end = parseInt('{{ str_replace('+', '', $stat['number']) }}');
                      const duration = 2000;
                      const start = Date.now();
                      const step = () => {
                        const now = Date.now();
                        const progress = Math.min((now - start) / duration, 1);
                        number = Math.floor(progress * end);
                        if (progress < 1) requestAnimationFrame(step);
                        else number = '{{ $stat['number'] }}';
                      };
                      requestAnimationFrame(step);
                    });
                  }"
                  x-text="number"
                ></p>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $stat['label'] }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Partners Section with Grid -->
  <section class="py-20">
    <x-content-container>
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 dark:text-white mb-4">
          Our Trusted Partners
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
          Working together with leading organizations to create sustainable impact.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($partners as $partner)
          <div
            class="group bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg p-8 transition-all duration-300"
            x-data="{ showDetails: false }"
            @mouseenter="showDetails = true"
            @mouseleave="showDetails = false"
          >
            <div class="relative h-32 flex items-center justify-center mb-6">
              <img
                src="{{ $partner['logo'] }}"
                alt="{{ $partner['name'] }}"
                class="h-full w-auto object-contain transition-opacity duration-300"
                :class="{ 'opacity-10': showDetails }"
              >
              <div
                class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300"
                :class="{ 'opacity-100': showDetails }"
              >
                <p class="text-sm text-gray-600 dark:text-gray-400 text-center px-4">
                  {{ $partner['description'] }}
                </p>
              </div>
            </div>
            <h3 class="text-xl font-semibold text-center text-gray-900 dark:text-white">
              {{ $partner['name'] }}
            </h3>
          </div>
        @endforeach
      </div>
    </x-content-container>
  </section>

  <!-- Projects Section with Timeline -->
  <section class="py-20 bg-gray-50 dark:bg-gray-900/50">
    <x-content-container>
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 dark:text-white mb-4">
          Featured Projects
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
          Discover our initiatives that are making a difference in communities.
        </p>
      </div>

      <div class="space-y-8">
        @foreach($projects as $index => $project)
          <div
            class="relative bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 md:p-8"
            x-data="{ expanded: false }"
            x-intersect="expanded = true"
          >
            <div class="md:grid md:grid-cols-5 md:gap-8">
              <div class="md:col-span-2">
                <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                  <x-heroicon-o-calendar class="w-4 h-4" />
                  <span>{{ $project['duration'] ?? 'Ongoing' }}</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">
                  {{ $project['name'] }}
                </h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                  {{ $project['description'] }}
                </p>
                <div class="flex items-center space-x-2 text-sm">
                  <span class="text-gray-500 dark:text-gray-400">Funded by:</span>
                  <span class="font-medium text-gray-900 dark:text-white">
                    {{ $project['funded_by'] }}
                  </span>
                </div>
              </div>
              <div class="hidden md:block md:col-span-3 relative">
                <div
                  class="h-full w-full bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden"
                  :class="{ 'transform translate-x-0 opacity-100': expanded, 'transform translate-x-8 opacity-0': !expanded }"
                >
                  @if(isset($project['image']))
                    <img
                      src="{{ $project['image'] }}"
                      alt="{{ $project['name'] }}"
                      class="w-full h-full object-cover"
                    >
                  @else
                    <div class="flex items-center justify-center h-full">
                      <x-heroicon-o-photo class="w-12 h-12 text-gray-400" />
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </x-content-container>
  </section>

  <!-- Call to Action Section -->
  <section class="relative py-20 overflow-hidden">
    <div class="absolute inset-0 bg-ca-primary"></div>
    <div
      class="absolute inset-0 bg-[url('/images/pattern.svg')] opacity-10"
      x-data="{}"
      x-init="window.addEventListener('mousemove', (e) => {
        const { clientX, clientY } = e;
        const xPos = (clientX / window.innerWidth - 0.5) * 20;
        const yPos = (clientY / window.innerHeight - 0.5) * 20;
        $el.style.transform = `translate(${xPos}px, ${yPos}px)`;
      })"
    ></div>
    <div class="relative z-10 container mx-auto px-4">
      <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-6">
          Ready to Make an Impact?
        </h2>
        <p class="text-xl text-white/90 mb-8">
          Join our network of partners and help us create lasting change in Malawi.
        </p>
        <a
          href="{{ route('contact') }}"
          class="inline-flex items-center px-8 py-4 bg-white text-ca-primary rounded-xl hover:bg-gray-50 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1"
        >
          Partner With Us
          <x-heroicon-o-arrow-right class="w-5 h-5 ml-2" />
        </a>
      </div>
    </div>
  </section>
</x-app-layout>
