<x-app-layout>
  <div class="relative bg-white py-16 sm:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <!-- Featured Projects Section -->
      @if($featuredProjects->count() > 0)
        <div class="mb-16">
          <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
            Featured Projects
          </h2>
          <div class="mt-8 grid gap-8 lg:grid-cols-3 sm:grid-cols-2">
            @foreach($featuredProjects as $project)
              <div class="group relative overflow-hidden rounded-2xl bg-white shadow-xl">
                <!-- Featured Image -->
                <div class="aspect-h-9 aspect-w-16 relative overflow-hidden">
                  @if($project->getFirstMedia('project_image'))
                    <img
                      src="{{ $project->getFirstMedia('project_image')->getUrl('preview') }}"
                      srcset="{{ $project->getFirstMedia('project_image')->getSrcset('preview') }}"
                      alt="{{ $project->title }}"
                      class="object-cover transition duration-300 group-hover:scale-105"
                    />
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

                <!-- Content -->
                <div class="p-6">
                  <h3 class="text-xl font-semibold text-gray-900">
                    <a href="{{ route('projects.show', $project) }}" class="hover:text-indigo-600">
                      {{ $project->title }}
                    </a>
                  </h3>
                  <p class="mt-3 text-base text-gray-500 line-clamp-3">
                    {{ $project->description }}
                  </p>

                  <!-- Project Meta -->
                  <div class="mt-6 flex items-center gap-x-6">
                    <div class="flex items-center gap-x-2">
                      <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                           fill="currentColor">
                        <path
                          d="M5.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H6a.75.75 0 01-.75-.75V12zM6 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H6zM7.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H8a.75.75 0 01-.75-.75V12zM8 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H8zM9.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V10zM10 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H10zM9.25 14a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V14zM12 9.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V10a.75.75 0 00-.75-.75H12z"/>
                      </svg>
                      <span class="text-sm text-gray-500">
                                                {{ $project->start_date->format('M Y') }} -
                                                {{ $project->end_date ? $project->end_date->format('M Y') : 'Present' }}
                                            </span>
                    </div>
                    <div class="flex items-center gap-x-2">
                      <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                           fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                              clip-rule="evenodd"/>
                      </svg>
                      <span class="text-sm text-gray-500">
                                                {{ number_format($project->people_reached) }} people reached
                                            </span>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif

      <!-- Impact Statistics -->
      @if($impactStats->count() > 0)
        <div class="mt-16 mb-16">
          <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl mb-8">
            Our Impact
          </h2>
          <dl class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($impactStats as $stat)
              <div class="flex flex-col">
                <dt class="text-base font-semibold text-gray-900">{{ $stat['label'] }}</dt>
                <dd class="text-4xl font-bold tracking-tight text-indigo-600">
                  {{ number_format($stat['number']) }}{{ $stat['suffix'] ?? '' }}
                </dd>
              </div>
            @endforeach
          </dl>
        </div>
      @endif

      <!-- All Projects -->
      <div class="mt-16">
        <div class="flex items-center justify-between mb-8">
          <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
            All Projects
          </h2>

          <!-- Filter Buttons -->
          <div class="flex gap-x-4">
            <button
              type="button"
              @click="activeFilter = 'all'"
              :class="{ 'bg-indigo-600 text-white': activeFilter === 'all', 'text-gray-700 hover:bg-gray-50': activeFilter !== 'all' }"
              class="rounded-md px-3.5 py-2.5 text-sm font-semibold shadow-sm ring-1 ring-inset ring-gray-300"
            >
              All
            </button>
            <button
              type="button"
              @click="activeFilter = 'current'"
              :class="{ 'bg-indigo-600 text-white': activeFilter === 'current', 'text-gray-700 hover:bg-gray-50': activeFilter !== 'current' }"
              class="rounded-md px-3.5 py-2.5 text-sm font-semibold shadow-sm ring-1 ring-inset ring-gray-300"
            >
              Current
            </button>
            <button
              type="button"
              @click="activeFilter = 'completed'"
              :class="{ 'bg-indigo-600 text-white': activeFilter === 'completed', 'text-gray-700 hover:bg-gray-50': activeFilter !== 'completed' }"
              class="rounded-md px-3.5 py-2.5 text-sm font-semibold shadow-sm ring-1 ring-inset ring-gray-300"
            >
              Completed
            </button>
            <button
              type="button"
              @click="activeFilter = 'upcoming'"
              :class="{ 'bg-indigo-600 text-white': activeFilter === 'upcoming', 'text-gray-700 hover:bg-gray-50': activeFilter !== 'upcoming' }"
              class="rounded-md px-3.5 py-2.5 text-sm font-semibold shadow-sm ring-1 ring-inset ring-gray-300"
            >
              Upcoming
            </button>
          </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-3 sm:grid-cols-2">
          @foreach($projects as $project)
            <div
              x-show="activeFilter === 'all' || activeFilter === '{{ $project->status }}'"
              x-transition:enter="transition ease-out duration-300"
              x-transition:enter-start="opacity-0 transform scale-95"
              x-transition:enter-end="opacity-100 transform scale-100"
              class="group relative overflow-hidden rounded-2xl bg-white shadow-xl"
            >
              <!-- Project Card Content (Same as Featured Projects) -->
              <div class="aspect-h-9 aspect-w-16 relative overflow-hidden">
                @if($project->getFirstMedia('project_image'))
                  <img
                    src="{{ $project->getFirstMedia('project_image')->getUrl('preview') }}"
                    srcset="{{ $project->getFirstMedia('project_image')->getSrcset('preview') }}"
                    alt="{{ $project->title }}"
                    class="object-cover transition duration-300 group-hover:scale-105"
                  />
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

                @if($project->tags->isNotEmpty())
                  <div class="absolute bottom-4 left-4 flex flex-wrap gap-2">
                    @foreach($project->tags as $tag)
                      <span
                        class="inline-flex items-center rounded-full bg-white/80 px-2 py-1 text-xs font-medium text-gray-900 backdrop-blur-sm">
                                                {{ $tag->name }}
                                            </span>
                    @endforeach
                  </div>
                @endif
              </div>

              <!-- Content -->
              <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-900">
                  <a href="{{ route('projects.show', $project) }}" class="hover:text-indigo-600">
                    {{ $project->title }}
                  </a>
                </h3>
                <p class="mt-3 text-base text-gray-500 line-clamp-3">
                  {{ $project->description }}
                </p>

                <!-- Project Meta -->
                <div class="mt-6 flex items-center gap-x-6">
                  <div class="flex items-center gap-x-2">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                         fill="currentColor">
                      <path d="M5.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H6a.75.75 0 01-.75-.75V12zM6 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H6zM7.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H8a.75.75 0 01-.75-.75V12zM8 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H8zM9.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V10zM10 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H10zM9.25 14a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V14z
                                        />
                                    </svg>
                                    <span class=" text-sm text-gray-500
                      ">
                      {{ $project->start_date->format('M Y') }} -
                      {{ $project->end_date ? $project->end_date->format('M Y') : 'Present' }}
                      </span>
                  </div>
                  @if($project->funded_by)
                    <div class="flex items-center gap-x-2">
                      <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                           fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0z"
                              clip-rule="evenodd"/>
                      </svg>
                      <span class="text-sm text-gray-500">
                                            Funded by {{ $project->funded_by }}
                                        </span>
                    </div>
                  @endif
                </div>
              </div>
              @endforeach
            </div>
        </div>
      </div>
    </div>

    @push('scripts')
      <script>
        document.addEventListener('alpine:init', () => {
          Alpine.data('projectsPage', () => ({
            activeFilter: 'all',
            init() {
              // Get filter from URL if present
              const urlParams = new URLSearchParams(window.location.search);
              const filter = urlParams.get('filter');
              if (filter) {
                this.activeFilter = filter;
              }
            },
            setFilter(filter) {
              this.activeFilter = filter;
              // Update URL
              const url = new URL(window.location);
              url.searchParams.set('filter', filter);
              window.history.pushState({}, '', url);
            }
          }))
        })
      </script>
    @endpush

    @push('styles')
      <style>
        /* Add any custom styles here */
        .aspect-h-9 {
          --tw-aspect-h: 9;
        }

        .aspect-w-16 {
          --tw-aspect-w: 16;
          padding-bottom: calc(var(--tw-aspect-h) / var(--tw-aspect-w) * 100%);
        }

        .line-clamp-3 {
          display: -webkit-box;
          -webkit-line-clamp: 3;
          -webkit-box-orient: vertical;
          overflow: hidden;
        }
      </style>
  @endpush
</x-app-layout>
