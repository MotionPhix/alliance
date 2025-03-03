<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListProjects extends ListRecords
{
  protected static string $resource = ProjectResource::class;

  protected function getHeaderActions(): array
  {
    return [
      Actions\CreateAction::make(),
    ];
  }

  public function getTabs(): array
  {
    return [
      'all' => \Filament\Resources\Pages\ListRecords\Tab::make('All Projects'),
      'current' => \Filament\Resources\Pages\ListRecords\Tab::make('Current')
        ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'current')),
      'upcoming' => \Filament\Resources\Pages\ListRecords\Tab::make('Upcoming')
        ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'upcoming')),
      'completed' => \Filament\Resources\Pages\ListRecords\Tab::make('Completed')
        ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'completed')),
      'featured' => \Filament\Resources\Pages\ListRecords\Tab::make('Featured')
        ->modifyQueryUsing(fn(Builder $query) => $query->where('is_featured', true)),
    ];
  }
}
