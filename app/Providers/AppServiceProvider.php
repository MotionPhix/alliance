<?php

namespace App\Providers;

use App\Models\BlogPost;
use App\Models\Tag;
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
    $this->configureBlogViewComposers();
  }

  /**
   * Configure view composers for blog pages.
   */
  private function configureBlogViewComposers(): void
  {
    View::composer('pages.blogs.*', function ($view) {
      $view->with([
        'popularPosts' => $this->getPopularPosts(),
        'tags' => $this->getBlogTags(),
      ]);
    });
  }

  /**
   * Get cached popular blog posts.
   */
  private function getPopularPosts()
  {
    return Cache::remember('popular_posts', now()->addHour(), function () {
      return BlogPost::query()
        ->published()
        ->select(['id', 'title', 'slug', 'published_at', 'view_count'])
        ->with('media')
        ->orderByDesc('view_count')
        ->limit(5)
        ->get();
    });
  }

  /**
   * Get cached blog tags with post counts.
   */
  private function getBlogTags()
  {
    return Cache::remember('blog_tags', now()->addHour(), function () {
      return Tag::query()
        ->whereHas('blogPosts', function ($query) {
          $query->published();
        })
        ->withCount(['blogPosts' => function ($query) {
          $query->published();
        }])
        ->orderByDesc('blog_posts_count')
        ->limit(10)
        ->get();
    });
  }
}
