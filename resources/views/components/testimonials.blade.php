@props(['testimonials'])

<section class="py-16 bg-gray-50 dark:bg-ca-secondary">
  <x-content-container>
    <h2 class="text-3xl font-display font-bold text-center mb-12 text-ca-primary dark:text-ca-highlight">
      What People Say About Us
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($testimonials as $testimonial)
{{--        <div class="bg-white dark:bg-ca-primary p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">--}}
{{--          <div class="flex items-center mb-4">--}}
{{--            <img src="{{ asset($testimonial['image']) }}"--}}
{{--                 alt="{{ $testimonial['name'] }}"--}}
{{--                 class="w-12 h-12 rounded-full object-cover">--}}
{{--            <div class="ml-4">--}}
{{--              <h3 class="text-lg font-semibold text-ca-primary dark:text-white">--}}
{{--                {{ $testimonial['name'] }}--}}
{{--              </h3>--}}
{{--              <p class="text-sm text-gray-500 dark:text-gray-300">--}}
{{--                {{ $testimonial['role'] }}--}}
{{--              </p>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--          <p class="text-gray-600 dark:text-gray-300">--}}
{{--            "{{ $testimonial['quote'] }}"--}}
{{--          </p>--}}
{{--        </div>--}}

        <!-- Card -->
        <div class="flex h-auto">
          <div class="flex flex-col bg-white rounded-xl dark:bg-neutral-900">
            <div class="flex-auto p-4 md:p-6">
              <p class="text-base italic md:text-lg text-gray-800 dark:text-neutral-200">
                " {{ $testimonial['quote'] }} "
              </p>
            </div>

            <div class="p-4 bg-gray-100 rounded-b-xl md:px-7 dark:bg-neutral-800">
              <div class="flex items-center gap-x-3">
                <div class="shrink-0">
                  <img class="size-8 sm:h-[2.875rem] sm:w-[2.875rem] rounded-full" src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80" alt="Avatar">
                </div>

                <div class="grow">
                  <p class="text-sm sm:text-base font-semibold text-gray-800 dark:text-neutral-200">
                    {{ $testimonial['name'] }}
                  </p>
                  <p class="text-xs text-gray-500 dark:text-neutral-400">
                    {{ $testimonial['role'] }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Card -->
      @endforeach
    </div>
  </x-content-container>
</section>
