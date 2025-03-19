<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;

class ProjectsOverview extends ChartWidget
{
  protected static ?string $heading = 'Projects by Status';
  protected static ?int $sort = 3;
  protected int | string | array $columnSpan = 1;

  protected function getData(): array
  {
    $statuses = ['current', 'completed', 'upcoming'];
    $counts = collect($statuses)->mapWithKeys(function ($status) {
      return [
        ucfirst($status) => Project::where('status', $status)->count()
      ];
    });

    return [
      'datasets' => [
        [
          'label' => 'Projects',
          'data' => $counts->values()->toArray(),
          'backgroundColor' => ['#0ea5e9', '#84cc16', '#eab308'],
        ],
      ],
      'labels' => $counts->keys()->toArray(),
    ];
  }

  protected function getType(): string
  {
    return 'doughnut';
  }
}
