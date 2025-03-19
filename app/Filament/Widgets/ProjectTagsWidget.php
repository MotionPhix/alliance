<?php

namespace App\Filament\Widgets;

use App\Models\Tag;
use Filament\Widgets\PieChartWidget;

class ProjectTagsWidget extends PieChartWidget
{
  protected static ?string $heading = 'Project Categories';

  protected static ?int $sort = 4;

  protected function getData(): array
  {
    $tags = Tag::withType('project')->withCount('projects')->get();

    return [
      'datasets' => [
        [
          'label' => 'Projects by Category',
          'data' => $tags->pluck('projects_count')->toArray(),
          'backgroundColor' => [
            '#10B981', '#3B82F6', '#F59E0B', '#EF4444',
            '#8B5CF6', '#EC4899', '#6366F1', '#14B8A6',
          ],
        ],
      ],
      'labels' => $tags->pluck('name')->toArray(),
    ];
  }
}
