<x-guest-layout>
  <x-slot name="title">
    {{ $project->title }}
  </x-slot>

  <x-slot name="description">
    {{ Str::limit(strip_tags($project->description), 160) }}
  </x-slot>

  <section class="py-16 bg-white dark:bg-ca-primary">
    <x-content-container>
      <div class="max-w-4xl mx-auto">
        {{-- Project Header --}}
        <div class="mb-8">
          <h1 class="text-4xl font-bold mb-4 text-ca-primary dark:text-white font-display">
            {{ $project->title }}
          </h1>

          <div class="flex flex-wrap gap-4 text-sm text-gray-500 dark:text-gray-400">
            @if($project->start_date)
              <div class="flex items-center">
                <x-heroicon-o-calendar class="w-5 h-5 mr-2"/>
                <span>Started: {{ $project->start_date->format('M d, Y') }}</span>
              </div>
            @endif

            @if($project->end_date)
              <div class="flex items-center">
                <x-heroicon-o-calendar class="w-5 h-5 mr-2"/>
                <span>End: {{ $project->end_date->format('M d, Y') }}</span>
              </div>
            @endif

            @if($project->status)
              <div class="flex items-center">
                <x-heroicon-o-check-circle class="w-5 h-5 mr-2"/>
                <span>Status: {{ $project->status }}</span>
              </div>
            @endif

            @if($project->funded_by)
              <div class="flex items-center">
                <x-heroicon-o-currency-dollar class="w-5 h-5 mr-2"/>
                <span>Funded by: {{ $project->funded_by }}</span>
              </div>
            @endif
          </div>

          @if($project->tags->isNotEmpty())
            <div class="mt-4 flex flex-wrap gap-2">
              @foreach($project->tags as $tag)
                <span
                  class="px-3 py-1 text-sm bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full">
                  {{ $tag->name }}
                </span>
              @endforeach
            </div>
          @endif
        </div>

        {{-- Project Featured Image --}}
        @if($project->hasMedia('project_image'))
          <div class="relative aspect-video mb-8">
            {{ $project->getFirstMedia('project_image')
                ->img('hero', [
                    'class' => 'w-full h-full object-cover rounded-lg shadow-lg',
                    'alt' => $project->title
                ]) }}
          </div>
        @endif

        {{-- Project Content --}}
        <div class="prose dark:prose-invert max-w-none mb-12">
          {!! $project->content !!}
        </div>

        {{-- Key Achievements --}}
        @if($project->key_achievements)
          <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6 text-ca-primary dark:text-ca-highlight font-display">
              Key Achievements
            </h2>
            <ul class="space-y-4">
              @foreach($project->key_achievements as $achievement)
                <li class="flex items-start">
                  <x-heroicon-o-check class="w-6 h-6 text-green-500 mr-3 flex-shrink-0 mt-1"/>
                  <span class="text-gray-700 dark:text-gray-300">{{ $achievement }}</span>
                </li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- Project Impact Stats --}}
        @if($project->people_reached || $project->budget)
          <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6 text-ca-primary dark:text-ca-highlight font-display">
              Project Impact
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              @if($project->people_reached)
                <div class="bg-gray-50 dark:bg-ca-secondary p-6 rounded-lg">
                  <div class="text-3xl font-bold text-ca-primary dark:text-ca-highlight mb-2">
                    {{ number_format($project->people_reached) }}
                  </div>
                  <div class="text-gray-600 dark:text-gray-400">
                    People Reached
                  </div>
                </div>
              @endif

              @if($project->budget)
                <div class="bg-gray-50 dark:bg-ca-secondary p-6 rounded-lg">
                  <div class="text-3xl font-bold text-ca-primary dark:text-ca-highlight mb-2">
                    ${{ number_format($project->budget) }}
                  </div>
                  <div class="text-gray-600 dark:text-gray-400">
                    Project Budget
                  </div>
                </div>
              @endif
            </div>
          </div>
        @endif

        {{-- Project Gallery --}}
        @if($project->hasMedia('project_gallery'))
          <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6 text-ca-primary dark:text-ca-highlight font-display">
              Project Gallery
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
              @foreach($project->getMedia('project_gallery') as $media)
                <div class="relative aspect-square">
                  {{ $media->img('preview', [
                      'class' => 'w-full h-full object-cover rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300',
                      'alt' => $media->name ?? $project->title
                  ]) }}
                </div>
              @endforeach
            </div>
          </div>
        @endif

        {{-- Call to Action --}}
        <div class="text-center">
          <a href="{{ route('contact') }}"
             class="inline-flex items-center px-6 py-3 bg-ca-highlight text-white rounded-lg hover:bg-ca-highlight/90 transition-colors duration-300">
            <x-heroicon-o-chat-bubble-left-right class="w-5 h-5 mr-2"/>
            Get Involved
          </a>
        </div>
      </div>
    </x-content-container>
  </section>
</x-guest-layout>
