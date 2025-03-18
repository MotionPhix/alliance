<x-app-layout>
  <x-slot name="title">{{ $post->title }}</x-slot>
  <x-slot name="description">{{ $post->excerpt }}</x-slot>

  <article class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-12 pb-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Article Header -->
      <header class="max-w-4xl mx-auto text-center mb-12">
        @if($post->tags->isNotEmpty())
          <div class="flex flex-wrap justify-center gap-2 mb-6">
            @foreach($post->tags as $tag)
              <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-medium bg-ca-primary/10 text-ca-primary">
                {{ $tag->name }}
              </span>
            @endforeach
          </div>
        @endif

        <h1 class="text-4xl md:text-5xl font-display font-bold text-gray-900 dark:text-white mb-6 leading-tight">
          {{ $post->title }}
        </h1>

        <div class="flex items-center justify-center space-x-6 text-gray-600 dark:text-gray-400">
          <div class="flex items-center">
            <x-heroicon-o-user-circle class="h-5 w-5 mr-2" />
            <span>{{ $post->user->name }}</span>
          </div>
          <div class="flex items-center">
            <x-heroicon-o-calendar class="h-5 w-5 mr-2" />
            <span>{{ $post->published_at->format('M d, Y') }}</span>
          </div>
          <div class="flex items-center">
            <x-heroicon-o-heart class="h-5 w-5 mr-2" />
            <span>{{ $post->likes->count() }} Likes</span>
          </div>
        </div>
      </header>

      <!-- Featured Image -->
      @if($post->hasMedia('blog_images'))
    <div class="max-w-5xl mx-auto mb-12">
        <div class="aspect-w-16 aspect-h-9 rounded-2xl overflow-hidden shadow-xl">
            <img
                src="{{ $post->getFirstMediaUrl('blog_images', 'preview') }}"
                srcset="{{ $post->getFirstMediaUrl('blog_images', 'thumbnail') }} 400w,
                        {{ $post->getFirstMediaUrl('blog_images') }} 1200w"
                sizes="(max-width: 768px) 100vw,
                       (max-width: 1200px) 85vw,
                       1200px"
                alt="{{ $post->title }}"
                class="w-full h-full object-cover"
                loading="lazy"
            >
        </div>
    </div>
@endif

      <!-- Article Content -->
      <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-8 md:p-12">
          <div class="prose dark:prose-invert prose-lg max-w-none">
            {!! $post->content !!}
          </div>

          <!-- Like Button -->
          <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
            <div
              x-data="{
                liked: {{ $post->likes->contains('user_id', auth()->id()) ? 'true' : 'false' }},
                likesCount: {{ $post->likes->count() }},
                isProcessing: false,
                async toggleLike() {
                  if (this.isProcessing) return;

                  this.isProcessing = true;

                  try {
                    if (!this.liked) {
                      await axios.post('{{ route('blogs.likes.store', $post->slug) }}');
                      this.liked = true;
                      this.likesCount++;
                    } else {
                      await axios.delete('{{ url('blogs/likes') }}/' + this.likeId);
                      this.liked = false;
                      this.likesCount--;
                    }
                  } catch (error) {
                    if (error.response?.status === 401) {
                      window.location.href = '/';
                    }
                  } finally {
                    this.isProcessing = false;
                  }
                }
              }"
             class="flex flex-col items-center space-y-4">
{{--              // {{ route('login') }}--}}
              <button
                @click="toggleLike"
                :disabled="isProcessing"
                :class="{
                  'bg-ca-primary hover:bg-ca-highlight': !liked,
                  'bg-red-600 hover:bg-red-700': liked,
                  'opacity-75 cursor-not-allowed': isProcessing
                }"
                class="inline-flex items-center px-6 py-3 text-white rounded-xl transition-all duration-300">
                <div class="relative">
                  {{-- Background Heart (Always visible) --}}
                  <x-heroicon-s-heart
                    class="h-5 w-5 mr-2 transition-transform duration-300"
                  />

                  {{-- Filled Heart (Shows when liked) --}}
                  <x-heroicon-s-heart
                    class="h-5 w-5 mr-2 absolute inset-0 transition-transform duration-300"
                  />
                </div>

                <span x-text="liked ? 'Unlike' : 'Like this post'"></span>
              </button>



              <!-- Like Counter with Animation -->
              <div class="flex items-center space-x-2 text-gray-600 dark:text-gray-400">
                <x-heroicon-s-heart class="h-4 w-4 text-red-500" />
                <span
                  x-text="likesCount"
                  class="transition-all duration-300"
                  :class="{ 'scale-125': isProcessing }">
                </span>

                <span x-text="likesCount === 1 ? 'Like' : 'Likes'"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Comments Section -->
        <section class="mt-12">
          <h2 class="text-2xl font-display font-bold text-gray-900 dark:text-white mb-8">
            Comments ({{ $post->comments->count() }})
          </h2>

          <!-- Comment Form -->
          <div x-data="{ content: '' }" class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 mb-8">
            <form @submit.prevent="
              axios.post('{{ route('blogs.comments.store', $post->slug) }}', { content: content })
                .then(response => {
                  location.reload();
                })
                .catch(error => {
                  if (error.response.status === 401) {
                    window.location.href = '/';
                  }
                });
            ">
              <textarea
                x-model="content"
                rows="4"
                class="w-full p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-ca-primary focus:border-transparent transition duration-200 ease-in-out"
                placeholder="Share your thoughts..."
              ></textarea>

              <div class="mt-4 flex justify-end">
                <button
                  type="submit"
                  class="inline-flex items-center px-6 py-3 bg-ca-primary text-white rounded-xl hover:bg-ca-highlight transition-colors duration-300">
                  <x-heroicon-o-paper-airplane class="h-5 w-5 mr-2" />
                  Post Comment
                </button>
              </div>
            </form>
          </div>

          <!-- Comments List -->
          <div class="space-y-6">
            @foreach($post->comments->sortByDesc('created_at') as $comment)
              <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6">
                <div class="flex items-start space-x-4">
                  <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-full bg-ca-primary/10 flex items-center justify-center">
                      <span class="text-ca-primary font-semibold text-lg">
                        {{ substr($comment->user->name, 0, 1) }}
                      </span>
                    </div>
                  </div>
                  <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-2">
                      <div>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">
                          {{ $comment->user->name }}
                        </h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                          {{ $comment->created_at->diffForHumans() }}
                        </p>
                      </div>
                      @if(auth()->id() === $comment->user_id)
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit"
                                  class="text-red-600 hover:text-red-800 dark:hover:text-red-400 transition-colors duration-300">
                            <x-heroicon-o-trash class="h-5 w-5" />
                          </button>
                        </form>
                      @endif
                    </div>
                    <p class="text-gray-700 dark:text-gray-300">
                      {{ $comment->content }}
                    </p>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </section>
      </div>
    </div>

    <!-- Toast Messages -->
    <div x-data="{ showMessage: false, message: '', isError: false }"
         x-init="
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
      <div x-show="showMessage"
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="opacity-0 transform translate-y-2"
           x-transition:enter-end="opacity-100 transform translate-y-0"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="opacity-100 transform translate-y-0"
           x-transition:leave-end="opacity-0 transform translate-y-2"
           class="fixed bottom-4 right-4 z-50">
        <div :class="{
          'bg-green-500': !isError,
          'bg-red-500': isError
        }" class="flex items-center space-x-2 text-white px-6 py-4 rounded-xl shadow-lg">
          <div class="flex-shrink-0">
            <template x-if="!isError">
              <x-heroicon-o-check-circle class="h-5 w-5" />
            </template>
            <template x-if="isError">
              <x-heroicon-o-x-circle class="h-5 w-5" />
            </template>
          </div>
          <p x-text="message" class="font-medium"></p>
        </div>
      </div>
    </div>
  </article>
</x-app-layout>
