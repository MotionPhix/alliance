<?php

namespace App\Filament\Widgets;

use App\Models\BlogPost;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class ContentCalendar extends ChartWidget
{
  protected static ?string $heading = 'Content Publishing Trend';
  protected static ?string $description = 'Number of posts published over time';
  protected static ?int $sort = 2;

  // Make the widget span two columns
  protected int | string | array $columnSpan = 2;

  protected function getData(): array
  {
    $data = Trend::model(BlogPost::class)
      ->between(
        start: now()->startOfMonth(),
        end: now()->endOfMonth(),
      )
      ->perDay()
      ->count();

    return [
      'datasets' => [
        [
          'label' => 'Posts Published',
          'data' => $data->map(fn (TrendValue $value) => $value->aggregate)->toArray(),
          'fill' => true,
          'backgroundColor' => 'rgba(14, 165, 233, 0.1)',
          'borderColor' => '#0ea5e9',
          'tension' => 0.2, // Add curve to the line
        ],
      ],
      'labels' => $data->map(function (TrendValue $value) {
        return Carbon::parse($value->date)->format('M d');
      })->toArray(),
    ];
  }

  protected function getType(): string
  {
    return 'line';
  }

  protected function getOptions(): array
  {
    return [
      'scales' => [
        'y' => [
          'beginAtZero' => true,
          'ticks' => [
            'stepSize' => 1,
          ],
        ],
        'x' => [
          'grid' => [
            'display' => false,
          ],
        ],
      ],
      'plugins' => [
        'legend' => [
          'display' => false,
        ],
      ],
      'maintainAspectRatio' => false,
      'height' => 300, // Set a fixed height
    ];
  }
}
