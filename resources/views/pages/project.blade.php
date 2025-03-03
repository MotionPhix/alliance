<x-guest-layout>
  <!-- Hero Section -->
  <div class="relative bg-gradient-to-r from-indigo-700 to-indigo-900">
    <div class="absolute inset-0">
      <img class="h-full w-full object-cover mix-blend-multiply" src="{{ asset('images/projects-hero.jpg') }}" alt="Projects background">
    </div>
    <div class="relative mx-auto max-w-7xl py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
      <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">Our Projects</h1>
      <p class="mt-6 max-w-3xl text-xl text-indigo-100">
        Discover how we're making a difference in communities across Malawi through our various initiatives and projects.
      </p>
    </div>
  </div>

  <!-- Main Content -->
  <div class="bg-white py-16 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <!-- Featured Projects Section -->
      @if($featuredProjects->count() > 0)
        <section aria-labelledby="featured-projects">
          <div class="sm:flex sm:items-center sm:justify-between">
            <h2 id="featured-projects" class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
              Featured Projects
            </h2>
            <p class="mt-2 text-sm text-gray-500 sm:mt-0">
              Our most impactful initiatives
            </p>
          </div>

          <div class="mt-8 grid gap-8 lg:grid-cols-3 sm:grid-cols-2">
            @foreach($featuredProjects as $project)
              <article class="group relative overflow-hidden rounded-lg bg-white shadow transition hover:shadow-lg">
                <div class="aspect-h-2 aspect-w-3 relative overflow-hidden">
                  @if($project->getFirstMedia('project_image'))
                    <img
                      src="{{ $project->getFirstMedia('project_image')->getUrl('preview') }}"
                      alt="{{ $project->title }}"
                      class="h-full w-full object-cover object-center transition duration-300 group-hover:scale-105"
                    />
                  @else
                    <div class="flex h-full items-center justify-center bg-gray-100">
                      <svg class="h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M4 4h16v12H4z"/>
                        <path d="M4 16h16v4H4z"/>
                      </svg>
                    </div>
                  @endif

                  <!-- Status Badge -->
                  <div class="absolute top-4 right-4">
                                        <span @class([
                                            'inline-flex items-center rounded-full px-3 py-0.5 text-sm font-medium',
                                            'bg-yellow-100 text-yellow-800' => $project->status === 'upcoming',
                                            'bg-green-100 text-green-800' => $project->status === 'current',
                                            'bg-blue-100 text-blue-800' => $project->status === 'completed',
                                        ])>
                                            {{ ucfirst($project->status) }}
                                        </span>
                  </div>
                </div>

                <div class="p-6">
                  <h3 class="text-xl font-semibold text-gray-900">
                    <a href="{{ route('projects.show', $project) }}">
                      <span class="absolute inset-0"></span>
                      {{ $project->title }}
                    </a>
                  </h3>
                  <p class="mt-3 text-base text-gray-500 line-clamp-2">
                    {{ $project->description }}
                  </p>

                  <div class="mt-6 flex items-center gap-x-6">
                    <div class="flex items-center gap-x-2">
                      <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                      <span class="text-sm text-gray-500">
                                                {{ $project->start_date->format('M Y') }}
                                            </span>
                    </div>

                    @if($project->people_reached)
                      <div class="flex items-center gap-x-2">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="text-sm text-gray-500">
                                                    {{ number_format($project->people_reached) }} reached
                                                </span>
                      </div>
                    @endif
                  </div>
                </div>
              </article>
            @endforeach
          </div>
        </section>
      @endif

      <!-- All Projects Section -->
      <section aria-labelledby="all-projects" class="mt-16">
        <div class="sm:flex sm:items-center sm:justify-between">
          <h2 id="all-projects" class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
            All Projects
          </h2>

          <!-- Filter Buttons -->
          <div class="mt-4 sm:mt-0 sm:ml-4">
            <div class="flex space-x-2">
              @foreach(['all', 'current', 'upcoming', 'completed'] as $filter)
                <button
                  type="button"
                  @click="activeFilter = '{{ $filter }}'"
                  :class="{
                                        'bg-indigo-600 text-white': activeFilter === '{{ $filter }}',
                                        'bg-white text-gray-700 hover:bg-gray-50': activeFilter !== '{{ $filter }}'
                                    }"
                  class="rounded-md px-3 py-2 text-sm font-medium shadow-sm ring-1 ring-inset ring-gray-300"
                >
                  {{ ucfirst($filter) }}
                </button>
              @endforeach
            </div>
          </div>
        </div>

        <div class="mt-8">
          @if($projects->count() > 0)
            <div class="grid gap-8 lg:grid-cols-3 sm:grid-cols-2">
              <!-- Project cards here (same as featured projects) -->
              @foreach($projects as $project)
                <!-- Same project card structure as featured projects -->
              @endforeach
            </div>
          @else
            <!-- Empty State -->
            <div class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">
              <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
              </svg>
              <h3 class="mt-2 text-sm font-medium text-gray-900">No projects</h3>
              <p class="mt-1 text-sm text-gray-500">
                @if($activeFilter === 'all')
                  We haven't started any projects yet.
                @else
                  No {{ $activeFilter }} projects at the moment.
                @endif
              </p>
            </div>
          @endif
        </div>

        <!-- Pagination (if needed) -->
        @if($projects->hasPages())
          <div class="mt-8">
            {{ $projects->links() }}
          </div>
        @endif
      </section>
    </div>
  </div>
</x-guest-layout>

@push('scripts')
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('projectsPage', () => ({
        activeFilter: 'all',
        init() {
          const urlParams = new URLSearchParams(window.location.search);
          this.activeFilter = urlParams.get('filter') || 'all';
        }
      }))
    })
  </script>
@endpush
