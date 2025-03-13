<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
  protected static string $resource = ProjectResource::class;

  protected function mutateFormDataBeforeCreate(array $data): array
  {
    return $data;
  }

  protected function afterCreate(): void
  {
    // The media will be automatically handled by Filament
  }
}
