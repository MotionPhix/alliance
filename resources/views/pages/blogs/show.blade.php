<x-app-layout>
  <x-slot name="title">{{ $post->title }}</x-slot>
  <x-slot name="description">{{ $post->excerpt }}</x-slot>

  <div class="container mx-auto px-4 py-12">
    <!-- Blog Post -->
    <article class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
      <!-- Post Image -->
      @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
             class="w-full h-64 object-cover rounded-lg mb-6">
      @endif

      <!-- Post Title -->
      <h1 class="text-3xl font-display font-bold text-gray-800 dark:text-gray-200 mb-4">
        {{ $post->title }}
      </h1>

      <!-- Post Meta -->
      <div class="flex items-center space-x-4 text-gray-600 dark:text-gray-400 mb-6">
        <span>{{ $post->published_at->format('M d, Y') }}</span>
        <span>•</span>
        <span>{{ $post->likes->count() }} Likes</span>
      </div>

      <!-- Post Content -->
      <div class="prose dark:prose-invert max-w-none">
        {!! $post->content !!}
      </div>

      <!-- Like Button -->
      <div class="mt-8">
        <form action="{{ route('likes.store', $post->slug) }}" method="POST" class="inline">
          @csrf
          <div x-data="{ liked: {{ $post->likes->contains('user_id', auth()->id()) ? 'true' : 'false' }}">
            <button @click="
              axios.post('{{ route('likes.store', $post->slug) }}')
                .then(response => {
                  liked = true;
                  location.reload(); // Refresh the page to update like count
                })
                .catch(error => {
                  if (error.response.status === 401) {
                    window.location.href = '{{ route('login') }}';
                  }
                });
            " x-show="!liked"
               class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            Like
            </button>

            <button @click="
              axios.delete('{{ route('likes.destroy', $post->likes->where('user_id', auth()->id())->first()) }}')
                .then(response => {
                  liked = false;
                  location.reload(); // Refresh the page to update like count
                });
            " x-show="liked"
                    class="flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-300">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
              </svg>
              Unlike
            </button>
          </div>
        </form>
      </div>
    </article>

    <!-- Comments Section -->
    <section class="mt-12">
      <h2 class="text-2xl font-display font-bold text-gray-800 dark:text-gray-200 mb-6">
        Comments ({{ $post->comments->count() }})
      </h2>

      <!-- Comment Form -->
      <form x-data="{ content: '' }" @submit.prevent="
          axios.post('{{ route('comments.store', $post->slug) }}', { content: content })
            .then(response => {
              location.reload(); // Refresh the page to show the new comment
            })
            .catch(error => {
              if (error.response.status === 401) {
                window.location.href = '{{ route('login') }}';
              }
            });
        ">
        @csrf
        <textarea
          x-model="content" rows="4"
          class="w-full p-4 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-blue-500"
          placeholder="Write a comment...">
        </textarea>

        <button
          type="submit"
          class="mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
          Submit Comment
        </button>
      </form>

      <!-- Comments List -->
      <div class="space-y-6">
        @foreach($post->comments as $comment)
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center space-x-4">
                <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                  <span class="text-gray-600 dark:text-gray-400">{{ substr($comment->user->name, 0, 1) }}</span>
                </div>
                <div>
                  <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $comment->user->name }}</p>
                  <p class="text-sm text-gray-600 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
              </div>
              @if(auth()->id() === $comment->user_id)
                <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          class="text-red-600 hover:text-red-800 dark:hover:text-red-400 transition-colors duration-300">
                    Delete
                  </button>
                </form>
              @endif
            </div>
            <p class="text-gray-700 dark:text-gray-300">{{ $comment->content }}</p>
          </div>
        @endforeach
      </div>

      <!-- Feedback Messages -->
      <div x-data="{ showMessage: false, message: '', isError: false }" x-init="
        @if(session('success'))
          showMessage = true;
          message = '{{ session('success') }}';
          isError = false;
          setTimeout(() => showMessage = false, 3000);
        @endif
        @if(session('error'))
          showMessage = true;
          message = '{{ session('error') }}';
          isError = true;
          setTimeout(() => showMessage = false, 3000);
        @endif
      ">
        <div x-show="showMessage" x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-2"
             class="fixed bottom-4 right-4 z-50">
          <div :class="{
      'bg-green-500': !isError,
      'bg-red-500': isError
    }" class="text-white px-6 py-3 rounded-lg shadow-lg">
            <p x-text="message"></p>
          </div>
        </div>
      </div>
    </section>
  </div>
</x-app-layout>
