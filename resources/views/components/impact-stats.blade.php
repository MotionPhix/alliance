@props(['metrics'])

<section class="py-16 bg-white dark:bg-ca-primary">
  <h2 class="text-3xl font-bold text-center mb-12 text-ca-primary dark:text-ca-highlight">
    Our Impact in Numbers
  </h2>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    @foreach($metrics as $metric)
      <div x-data="{ count: 0, target: {{ (int) str_replace(',', '', $metric['metric']) }}, duration: 2000 }"
           x-init="() => {
             const increment = target / (duration / 16);
             const updateCount = () => {
               if (count < target) {
                 count = Math.ceil(count + increment);
                 if (count > target) count = target;
                 $refs.count.textContent = count.toLocaleString();
                 requestAnimationFrame(updateCount);
               }
             };
             updateCount();
           }"
           class="impact-card group p-6 rounded-xl bg-gray-50 dark:bg-ca-secondary transition-all duration-300 hover:bg-ca-highlight/10 dark:hover:bg-ca-highlight/20 hover:shadow-xl">
        <div class="w-12 h-12 mb-4 text-ca-primary dark:text-ca-highlight transform group-hover:scale-110 transition-transform duration-300">
          <!-- Dynamic Icons -->
          @if($metric['icon'] == 'users')
            <x-heroicon-o-users class="w-full h-full" />
          @elseif($metric['icon'] == 'school')
            <x-heroicon-o-academic-cap class="w-full h-full" />
          @elseif($metric['icon'] == 'medical')
            <x-carbon-military-camp class="w-full h-full" />
          @elseif($metric['icon'] == 'training')
            <x-carbon-course class="w-full h-full" />
          @elseif($metric['icon'] == 'women')
            <x-mdi-human-female class="w-full h-full" />
          @elseif($metric['icon'] == 'volunteers')
            <x-heroicon-o-credit-card class="w-full h-full" />
          @elseif($metric['icon'] == 'agriculture')
            <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full fill-current stroke-2" viewBox="0 0 512 512">
              <path d="m255.688 23.688 2.802.006c13.704.051 27.06.449 40.51 3.306l2.989.618C337.775 35.188 371.562 49.733 400 73l3.02 2.402C417.957 87.48 431.82 101.362 443 117l1.372 1.892c6.954 9.635 13.13 19.575 18.628 30.108l1.116 2.117C475.17 172.361 482.13 195.411 486 219l.558 3.288c1.682 11.006 1.84 21.91 1.817 33.024l-.002 2.94c-.04 15.584-.915 30.497-4.373 45.748l-.666 2.99C475.57 340.957 460.832 372.757 439 400c-.77.973-1.54 1.946-2.332 2.95C424.575 417.91 410.662 431.802 395 443l-1.892 1.372c-9.635 6.954-19.575 13.13-30.108 18.628l-2.117 1.116c-32.253 16.782-68.026 24.34-104.195 24.259l-2.784-.002C202.38 488.233 152.355 471.341 112 439c-.973-.77-1.946-1.54-2.95-2.332C94.09 424.575 80.198 410.662 69 395l-1.372-1.892C60.674 383.473 54.498 373.533 49 363l-1.116-2.117c-16.37-31.464-24.282-66.408-24.2-101.735.003-2.815-.02-5.628-.045-8.443-.06-17.072 1.972-33.69 6.111-50.268l.785-3.17C38.464 166.12 52.887 137.098 73 112c.77-.973 1.54-1.946 2.332-2.95C87.425 94.09 101.338 80.198 117 69l1.892-1.372C128.527 60.674 138.467 54.498 149 49l2.117-1.116c32.511-16.916 68.152-24.35 104.57-24.197ZM103 104l-2.05 1.926C69.506 136.212 50.897 178.754 43 221l-.402 2.099C40.4 234.972 40.796 246.975 41 259c7.543-2.009 7.543-2.009 15.02-4.246 55.775-17.52 116.423-10.808 168.917 13.746l2.146 1.003c7.176 3.46 14.03 7.502 20.917 11.497.025-7.815.043-15.629.055-23.444.005-2.66.012-5.321.02-7.982.013-3.815.018-7.63.023-11.445l.015-3.63v-3.337l.007-2.954c.128-2.183.128-2.183-1.12-3.208-1.72-.196-3.442-.386-5.166-.543-19.472-1.821-38.929-7.018-54.037-20.012-1.746-1.53-1.746-1.53-3.906-2.39-2.394-1.336-2.804-2.583-3.891-5.055-.855-1.1-1.732-2.182-2.625-3.25C163.644 175.678 156.277 148.6 159 126c1.466-3.733 1.466-3.733 4-5 25.176-2.31 51.893 3.485 71.977 19.352C240.69 145.327 245.232 150.418 249 157c2.319-2.319 2.698-4.243 3.495-7.357 4.79-18.61 14.279-35.438 30.743-46.061 17.094-9.792 35.3-14.728 55.012-14.832l3.008-.063 2.883-.015 2.61-.028c2.754.436 3.587 1.155 5.249 3.356 5.546 16.639-2.388 42.54-9.875 57.625-3.105 5.969-6.596 11.373-11.125 16.375l-1.758 2.035c-15.436 16.76-40.284 23.598-62.406 24.79-1.853-.02-1.853-.02-2.836 1.175a204.134 204.134 0 0 0-.114 8.1v2.572c0 2.819.009 5.638.016 8.457l.005 5.847c.003 5.141.013 10.282.024 15.423.01 5.241.015 10.483.02 15.724.01 10.292.028 20.585.049 30.877l2.876-1.654 3.793-2.176 1.89-1.087c54.738-31.366 120.063-38.618 180.762-22.278 5.918 1.649 11.802 3.41 17.679 5.195 1.783-47.723-13.668-95.22-43-133l-2.363-3.059C420.09 115.997 414.087 109.468 408 103l-1.867-1.996c-38.1-39.467-94.432-59.728-148.378-60.968C198.937 39.265 145.013 63.842 103 104Zm216.375 2.625-2.363.538C305.722 109.88 295.695 114.128 287 122l-2.625 2.375L282 127l-1.645 1.816c-7.54 8.92-11.176 19.338-13.73 30.559l-.509 2.232c-1.02 4.882-1.262 9.408-1.116 14.393 17.724 1.125 36.51-5.632 50.055-17.117 12.742-12.333 19.909-29.548 21.183-47.18.01-2.236-.096-4.472-.238-6.703-5.802-.17-10.972.337-16.625 1.625ZM176 137c-1.137 17.915 5.467 36.409 17 50 14.008 15.384 34.089 20.035 54 22 .178-5.84-.37-11.004-1.688-16.688l-.545-2.373C241.528 176.405 236.534 164.48 226 155l-1.371-1.383c-11.03-10.507-29.884-16.94-45.004-16.68L176 137ZM42 277l-.063 3.563-.035 2.003c.128 3.184.633 6.284 1.098 9.434l2.613-.21C70.134 289.971 95.81 289.16 120 294l3.017.602c40.989 8.48 78.936 26.944 109.76 55.363 2.012 1.841 4.071 3.596 6.16 5.348C253.798 368.36 265.899 385.09 276 402l1.19 1.968C288.815 423.393 296.606 444.35 303 466c7.638-1.182 14.766-3.03 22.063-5.563l2.833-.958c4.636-1.535 4.636-1.535 9.104-3.479-3.493-53.905-31.69-105.855-71.914-141.41C248.553 300.56 230.649 289.146 211 280l-3.441-1.613C157.106 255.762 92.598 253.31 42 277Zm230 19c-.348 3.22-.348 3.22 2.422 5.496a356.64 356.64 0 0 0 3.328 2.942c1.196 1.073 2.39 2.149 3.582 3.226l1.85 1.669C290.218 315.785 296.954 322.61 303 330a566.795 566.795 0 0 0 17.625-9.875c14.135-8.133 28.85-14.18 44.375-19.125l2.269-.723c12.665-3.949 25.61-6.39 38.731-8.277l2.253-.326c7.937-.966 15.93-.825 23.913-.804 2.499.005 4.997 0 7.496-.007 9.823-.003 19.546.33 29.338 1.137.59-3.837 1.13-7.552 1.063-11.438L470 277c-60.03-24.57-145.336-23.555-198 19ZM47 309a380.907 380.907 0 0 0 4 15l1.027 3.598 1.098 3.214.945 2.895c3.154 3.747 7.252 3.637 11.93 4.293 1.916.35 3.83.709 5.742 1.078l3.009.57C106.911 345.85 138.323 357.605 165 377l2.895 2.07c26.227 19.18 47.922 42.65 64.417 70.68l1.257 2.12c1.913 3.287 3.662 6.55 5.15 10.052 2.599 6.331 2.599 6.331 7.898 10.133 3.552.37 6.82.213 10.383-.055a714.9 714.9 0 0 1 5.008-.172c7.718-.277 15.338-.789 22.992-1.828 1.28-3.84.272-6.243-.938-9.938l-.684-2.121C276.16 436.11 266.448 415.687 253 397l-1.218-1.693C245.468 386.627 238.423 378.74 231 371l-2.715-2.875c-36.171-37.393-90.499-60.334-142.328-61.438a690.8 690.8 0 0 0-9.332-.062l-2.23-.006c-9.28.003-18.25.663-27.395 2.381Zm348 1-2.566.52c-27.999 5.768-54.63 16.61-78.434 32.48 1.53 4.275 3.734 7.98 6.125 11.813 3.753 6.118 7.092 12.361 10.223 18.82 1.73 3.566 3.551 7.004 5.652 10.367 4.594-2.457 8.808-5.239 13.063-8.25 6.72-4.718 13.707-8.863 20.937-12.75l1.838-.996c22.958-12.314 47.67-19.922 73.396-23.712l2.899-.433 2.559-.36c2.475-.535 4.21-1.07 6.308-2.499 1.168-2.097 1.168-2.097 1.887-4.613l.904-2.783.897-2.916c.46-1.427.46-1.427.931-2.881 1.358-4.25 2.564-8.416 3.381-12.807-5.606-2.803-13.285-2.165-19.453-2.203l-2.346-.021c-2.484-.018-4.967-.024-7.451-.026l-2.577-.002c-12.956.016-25.462.551-38.173 3.252ZM65 355c21.87 48.591 68.48 85.547 117.457 104.137C202.3 466.277 202.3 466.277 223 469c-1.38-4.682-3.353-8.723-5.875-12.875l-1.186-1.959C203.218 433.596 186.959 414.97 168 400l-2.852-2.332c-19.742-15.789-41.591-27.018-65.46-35.043l-3.756-1.264C80.774 356.395 80.774 356.395 65 355Zm292 35-1.964 1.39c-6.975 4.331-6.975 4.331-11.75 10.47-.339 2.534.046 4.128.788 6.57l.77 2.63c.278.929.556 1.858.844 2.815 3.24 11.255 5.431 22.574 7.312 34.125 39.976-18.293 75.295-53.162 94-93-29.513-2.083-66.84 18.522-90 35Z"/>
            </svg>
          @else
            <x-carbon-rain-drop class="w-full h-full" />
          @endif
        </div>

        <div class="text-4xl font-bold mb-2 text-ca-primary dark:text-white">
          <span x-ref="count">0</span>+
        </div>

        <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-gray-200">
          {{ $metric['title'] }}
        </h3>
        <p class="text-gray-600 dark:text-gray-300">
          {{ $metric['description'] }}
        </p>
      </div>
    @endforeach
  </div>
</section>
