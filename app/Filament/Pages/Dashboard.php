<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
  protected static string $view = 'filament.pages.dashboard';

  public function getColumns(): int|string|array
  {
    return [
      'default' => 1,
      'sm' => 2,
      'md' => 3,
      'lg' => 4,
    ];
  }

  public function getWidgets(): array
  {
    return [
      \App\Filament\Widgets\StatsOverview::class,
      \App\Filament\Widgets\LatestBlogPosts::class,
      \App\Filament\Widgets\ProjectsOverview::class,
      \App\Filament\Widgets\ContentCalendar::class,
    ];
  }
}
