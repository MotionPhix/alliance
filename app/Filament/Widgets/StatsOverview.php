<?php

namespace App\Filament\Widgets;

use App\Models\BlogPost;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class StatsOverview extends BaseWidget
{
  protected static ?string $pollingInterval = '15s';

  protected function getStats(): array
  {
    // Get blog posts trend data
    $blogPostsTrend = Trend::model(BlogPost::class)
      ->between(
        start: now()->subWeek(),
        end: now(),
      )
      ->perDay()
      ->count();

    // Get projects trend data
    $projectsTrend = Trend::model(Project::class)
      ->between(
        start: now()->subWeek(),
        end: now(),
      )
      ->perDay()
      ->count();

    // Get views trend data
    $viewsTrend = Trend::query(BlogPost::query())
      ->between(
        start: now()->subWeek(),
        end: now(),
      )
      ->perDay()
      ->sum('view_count');

    return [
      Stat::make('Total Blog Posts', BlogPost::count())
        ->description('Published posts: ' . BlogPost::where('is_published', true)->count())
        ->descriptionIcon('heroicon-m-document-text')
        ->chart($blogPostsTrend->map(fn (TrendValue $value) => $value->aggregate)->toArray())
        ->color('success'),

      Stat::make('Active Projects', Project::where('status', 'current')->count())
        ->description('Total projects: ' . Project::count())
        ->descriptionIcon('heroicon-m-briefcase')
        ->chart($projectsTrend->map(fn (TrendValue $value) => $value->aggregate)->toArray())
        ->color('warning'),

      Stat::make('Total Blog Views', BlogPost::sum('view_count'))
        ->description('This month: ' . BlogPost::whereMonth('created_at', now()->month)->sum('view_count'))
        ->descriptionIcon('heroicon-m-cursor-arrow-rays')
        ->chart($viewsTrend->map(fn (TrendValue $value) => $value->aggregate)->toArray())
        ->color('primary'),
    ];
  }
}
