<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ProjectsOverviewWidget;
use App\Filament\Widgets\LatestProjectsWidget;
use App\Filament\Widgets\ProjectStatisticsWidget;
use App\Filament\Widgets\ProjectTagsWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
  public function getWidgets(): array
  {
    return [
      ProjectsOverviewWidget::class,
      LatestProjectsWidget::class,
      ProjectStatisticsWidget::class,
      ProjectTagsWidget::class,
    ];
  }

  public function getColumns(): int | array
  {
    return [
      'default' => 1,
      'sm' => 2,
      'lg' => 3,
    ];
  }
}
