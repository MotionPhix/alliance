<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class ProjectsOverviewWidget extends BaseWidget
{
  protected function getCards(): array
  {
    return [
      Card::make('Total Projects', Project::count())
        ->description('All projects in the system')
        ->descriptionIcon('heroicon-o-briefcase')
        ->chart(Project::query()
          ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
          ->groupBy('date')
          ->pluck('count')
          ->toArray())
        ->color('primary'),

      Card::make('Featured Projects', Project::featured()->count())
        ->description('Projects marked as featured')
        ->descriptionIcon('heroicon-s-star')
        ->color('success'),

      Card::make('Total Impact', Project::sum('people_reached'))
        ->description('People reached through all projects')
        ->descriptionIcon('heroicon-s-users')
        ->color('warning'),
    ];
  }
}
