<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ProjectStatisticsWidget extends LineChartWidget
{
  protected static ?string $heading = 'Project Growth';

  protected int | string | array $columnSpan = 'full';

  protected static ?int $sort = 3;

  protected function getData(): array
  {
    $data = Trend::model(Project::class)
      ->between(
        start: now()->startOfYear(),
        end: now()->endOfYear(),
      )
      ->perMonth()
      ->count();

    return [
      'datasets' => [
        [
          'label' => 'Projects Created',
          'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
          'borderColor' => '#10B981',
        ],
      ],
      'labels' => $data->map(fn (TrendValue $value) => $value->date),
    ];
  }
}
