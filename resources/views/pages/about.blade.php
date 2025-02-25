<x-app-layout>
  <x-slot name="title">About Us</x-slot>
  <x-slot name="description">Learn about Citizen Alliance, our mission, values, and the team driving positive change in Malawi.</x-slot>

  <!-- Hero Section -->
  <section class="relative py-20 bg-blue-600 text-white overflow-hidden">
    <div class="absolute inset-0 bg-[url('/img/pattern.svg')] opacity-10"></div>
    <div class="container mx-auto px-4 relative">
      <div class="max-w-3xl">
        <h1 class="text-4xl md:text-5xl font-bold mb-6 animate-fade-in">
          Empowering Citizens for Positive Change
        </h1>
        <p class="text-xl md:text-2xl opacity-90 mb-8 animate-fade-in-delay">
          Since 2012, we've been working to strengthen citizen participation in governance and development processes across Malawi.
        </p>
      </div>
    </div>
  </section>

  <!-- Mission & Vision Section -->
  <section class="py-16">
    <div class="container mx-auto px-4">
      <div class="grid md:grid-cols-2 gap-12">
        <div class="bg-white rounded-lg shadow-lg p-8">
          <div class="w-16 h-16 bg-blue-600 text-white rounded-lg flex items-center justify-center mb-6">
            <x-heroicon-o-eye class="w-8 h-8" />
          </div>
          <h2 class="text-2xl font-bold mb-4">Our Vision</h2>
          <p class="text-gray-600 leading-relaxed">
            A Malawi where citizens are actively engaged in governance processes and their voices are heard and respected in decisions affecting their lives.
          </p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8">
          <div class="w-16 h-16 bg-blue-600 text-white rounded-lg flex items-center justify-center mb-6">
            <x-heroicon-o-flag class="w-8 h-8" />
          </div>
          <h2 class="text-2xl font-bold mb-4">Our Mission</h2>
          <p class="text-gray-600 leading-relaxed">
            To strengthen citizen participation in governance and development processes through advocacy, capacity building, and fostering dialogue between citizens and duty bearers.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Values Section -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="text-center max-w-3xl mx-auto mb-12">
        <h2 class="text-3xl font-bold mb-4">Our Core Values</h2>
        <p class="text-gray-600">
          The principles that guide our work and shape our approach to community development.
        </p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($values as $value)
          <div class="bg-white rounded-lg shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="w-12 h-12 bg-blue-600 text-white rounded-lg flex items-center justify-center mb-4">
              @if($value['icon'] === 'scale')
                <x-heroicon-o-scale class="w-6 h-6" />
              @elseif($value['icon'] === 'hand')
                <x-heroicon-o-hand-raised class="w-6 h-6" />
              @else
                <x-heroicon-o-light-bulb class="w-6 h-6" />
              @endif
            </div>

            <h3 class="text-xl font-semibold mb-2">{{ $value['title'] }}</h3>
            <p class="text-gray-600">{{ $value['description'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Team Section -->
  <section class="py-16">
    <div class="container mx-auto px-4">
      <div class="text-center max-w-3xl mx-auto mb-12">
        <h2 class="text-3xl font-bold mb-4">Our Team</h2>
        <p class="text-gray-600">Meet the dedicated professionals working to make a difference in our communities.</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($team as $member)
          <x-team-member-card :member="$member" />
        @endforeach
      </div>
    </div>
  </section>

  <!-- Timeline Section -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="text-center max-w-3xl mx-auto mb-12">
        <h2 class="text-3xl font-bold mb-4">Our Journey</h2>
        <p class="text-gray-600">A timeline of our growth and impact since establishment.</p>
      </div>

      <div class="max-w-4xl mx-auto">
        @foreach($timeline as $index => $item)
          <div class="flex items-start mb-8 last:mb-0">
            <div class="flex-shrink-0 w-24 pt-1">
              <span class="text-blue-600 font-bold">{{ $item['year'] }}</span>
            </div>
            <div class="flex-grow pl-8 border-l-2 border-blue-600">
              <h3 class="text-xl font-semibold mb-2">{{ $item['title'] }}</h3>
              <p class="text-gray-600">{{ $item['description'] }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Partners Section -->
  <section class="py-16">
    <div class="container mx-auto px-4">
      <div class="text-center max-w-3xl mx-auto mb-12">
        <h2 class="text-3xl font-bold mb-4">Our Partners</h2>
        <p class="text-gray-600">Organizations we work with to create positive change.</p>
      </div>

      <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($partners as $partner)
          <a href="{{ $partner['website'] }}"
             target="_blank"
             class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-center transform hover:-translate-y-1 transition-transform duration-300">
            <img src="{{ asset($partner['logo']) }}"
                 alt="{{ $partner['name'] }}"
                 class="max-h-16">
          </a>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Call to Action Section -->
  <section class="py-16 bg-blue-600 text-white">
    <div class="container mx-auto px-4">
      <div class="text-center max-w-3xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Join Us in Making a Difference</h2>
        <p class="text-xl opacity-90 mb-8">
          Whether you're an organization looking to partner with us or an individual wanting to support our cause,
          we welcome your involvement.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
          <a href="{{ route('contact') }}"
             class="inline-flex items-center justify-center px-6 py-3 border-2 border-white text-white rounded-lg hover:bg-white hover:text-blue-600 transition-colors duration-300">
            Contact Us
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>
          <a href="#"
             class="inline-flex items-center justify-center px-6 py-3 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-300">
            Partnership Opportunities
          </a>
        </div>
      </div>
    </div>
  </section>
</x-app-layout>
