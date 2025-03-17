<?php

namespace App\Providers;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      DB::listen(function(QueryExecuted $query) {
        $is_insert = strpos($query->sql, "insert into") !== false;
        $is_orderitem = strpos($query->sql, "order_items") !== false;
        $is_mediaitem = strpos($query->sql, "media") !== false;
        if ($is_insert && ($is_orderitem || $is_mediaitem)) {
          Log::info(
            $query->sql,
            [
              'bindings' => $query->bindings,
              'time' => $query->time
            ]
          );
        }

      });

      // Add view composers for sidebar and popular posts
      View::composer('pages.blogs.*', function ($view) {
        $view->with('popularPosts', Cache::remember('popular_posts', 3600, function () {
          return \App\Models\BlogPost::published()
            ->orderBy('view_count', 'desc')
            ->limit(5)
            ->get();
        }));

        $view->with('tags', Cache::remember('blog_tags', 3600, function () {
          return \App\Models\Tag::withType('blog_tags')
            ->withCount([
              'taggables as blog_posts_count' => function ($query) {
                $query->where('taggable_type', \App\Models\BlogPost::class);
              }
            ])
            ->orderBy('blog_posts_count', 'desc')
            ->limit(10)
            ->get();
        }));
      });
    }
}
