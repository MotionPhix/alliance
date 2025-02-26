<x-app-layout>
  <x-slot name="title">Partnerships</x-slot>
  <x-slot name="description">
    Citizen Alliance collaborates with global and local partners to drive development and governance initiatives in Malawi.
  </x-slot>

  <!-- Hero Section -->
  <section class="relative">
    <div class="relative w-full h-[400px] overflow-hidden">
      <img src="{{ asset('images/partnerships-hero.jpg') }}" alt="Partnerships"
           class="object-cover w-full h-full transform hover:scale-105 transition-transform duration-500">
      <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-black/70"></div>
      <div class="absolute inset-0 flex items-center">
        <div class="container mx-auto px-4 text-center">
          <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 font-display">Our Partnerships</h1>
          <p class="text-xl md:text-2xl text-white max-w-2xl mx-auto">
            Collaborating with global and local partners to empower citizens and drive sustainable development in Malawi.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Partners Section -->
  <x-content-container class="py-16">
    <h2 class="text-3xl font-bold text-center mb-8 font-display">Our Partners</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($partners as $partner)
        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300">
          <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}" class="w-auto h-24 mx-auto mb-6">
          <h3 class="text-xl font-semibold text-center mb-4">{{ $partner['name'] }}</h3>
          <p class="text-gray-600 text-center">{{ $partner['description'] }}</p>
        </div>
      @endforeach
    </div>
  </x-content-container>

  <!-- Projects Section -->
  <x-content-container class="py-16 bg-gray-50">
    <h2 class="text-3xl font-bold text-center mb-8">Key Projects</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($projects as $project)
        <div class="bg-white rounded-lg shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300">
          <h3 class="text-xl font-semibold mb-4">{{ $project['name'] }}</h3>
          <p class="text-gray-600 mb-4">{{ $project['description'] }}</p>
          <p class="text-sm text-gray-500">Funded by: {{ $project['funded_by'] }}</p>
        </div>
      @endforeach
    </div>
  </x-content-container>

  <!-- Impact Section -->
  <x-content-container class="py-16">
    <h2 class="text-3xl font-bold text-center mb-8">Impact of Our Partnerships</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <div class="text-center">
        <p class="text-4xl font-bold text-blue-600">50,000+</p>
        <p class="text-gray-600">People Reached</p>
      </div>
      <div class="text-center">
        <p class="text-4xl font-bold text-blue-600">32</p>
        <p class="text-gray-600">Schools Supported</p>
      </div>
      <div class="text-center">
        <p class="text-4xl font-bold text-blue-600">85</p>
        <p class="text-gray-600">Medical Camps</p>
      </div>
      <div class="text-center">
        <p class="text-4xl font-bold text-blue-600">450+</p>
        <p class="text-gray-600">Training Sessions</p>
      </div>
    </div>
  </x-content-container>

  <!-- Call to Action Section -->
  <section class="py-16 bg-blue-600 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('/images/pattern.svg')] opacity-10"></div>
    <div class="container mx-auto px-4 relative">
      <div class="text-center max-w-3xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Partner With Us</h2>
        <p class="text-xl mb-8">
          Join us in our mission to empower citizens and drive sustainable development in Malawi.
        </p>
        <a href="{{ route('contact') }}"
           class="inline-flex items-center px-8 py-3 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-300">
          Get in Touch
          <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 8l4 4m0 0l-4 4m4-4H3"/>
          </svg>
        </a>
      </div>
    </div>
  </section>
</x-app-layout>
