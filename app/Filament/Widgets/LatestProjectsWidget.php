<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestProjectsWidget extends BaseWidget
{
  protected int | string | array $columnSpan = 'full';

  protected static ?int $sort = 2;

  public function getTableQuery(): Builder
  {
    return Project::query()
      ->latest()
      ->limit(5);
  }

  protected function getTableColumns(): array
  {
    return [
      Tables\Columns\SpatieMediaLibraryImageColumn::make('project_image')
        ->collection('project_image')
        ->conversion('thumbnail')
        ->square(),

      Tables\Columns\TextColumn::make('name')
        ->searchable()
        ->sortable(),

      Tables\Columns\TextColumn::make('funded_by'),

      Tables\Columns\BooleanColumn::make('is_featured')
        ->trueIcon('heroicon-s-star')
        ->falseIcon('heroicon-s-x-circle'),

      Tables\Columns\TextColumn::make('created_at')
        ->dateTime()
        ->sortable(),
    ];
  }
}
