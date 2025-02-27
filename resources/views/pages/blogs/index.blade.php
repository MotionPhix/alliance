<x-app-layout>
  <x-slot name="title">Blog</x-slot>
  <x-slot name="description">Read the latest blog posts from Citizen Alliance.</x-slot>

  <div class="py-12">
    <x-content-container>
      <!-- Search and Filters -->
      <div class="mb-8">
        <form action="{{ route('blogs.index') }}" method="GET" class="relative flex items-center">
          <input type="text" name="search" placeholder="Search posts..." value="{{ request('search') }}"
                 class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-blue-500">
          <button
            type="submit"
            class="absolute right-0 flex items-center px-6 py-3 bg-ca-primary text-white rounded-e-lg hover:bg-ca-highlight transition-colors duration-300">
            <x-heroicon-o-search /> <span>Search</span>
          </button>
        </form>
      </div>

      <!-- Blog Posts -->
      @if($posts->isEmpty())
        <div class="text-center py-16">
          <p class="text-gray-600 dark:text-gray-400">
            No blog posts found.
          </p>
        </div>
      @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          @foreach($posts as $post)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
              <a href="{{ route('blog.show', $post->slug) }}">
                @if($post->image)
                  <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                       class="w-full h-48 object-cover rounded-t-lg">
                @endif
                <div class="p-6">
                  <h3 class="text-xl font-display font-semibold text-gray-800 dark:text-gray-200 mb-2">
                    {{ $post->title }}
                  </h3>
                  <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $post->excerpt }}</p>
                  <div class="flex items-center space-x-4 text-gray-600 dark:text-gray-400">
                    <span>{{ $post->published_at->format('M d, Y') }}</span>
                    <span>•</span>
                    <span>{{ $post->likes->count() }} Likes</span>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
          {{ $posts->links() }}
        </div>
      @endif
    </x-content-container>
  </div>
</x-app-layout>
