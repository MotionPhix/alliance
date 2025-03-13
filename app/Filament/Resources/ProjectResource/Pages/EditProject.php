<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProject extends EditRecord
{
  protected static string $resource = ProjectResource::class;

  protected function getHeaderActions(): array
  {
    return [
      Actions\DeleteAction::make(),
    ];
  }

  protected function mutateFormDataBeforeFill(array $data): array
  {
    // Ensure we're loading the relationships
    $this->record->load(['media', 'tags']);

    return $data;
  }

  protected function beforeSave(): void
  {
    // This method is called before the record is saved
    // You can add any pre-save logic here if needed
  }

  protected function afterSave(): void
  {
    // This method is called after the record is saved
    // You can add any post-save logic here if needed
  }

  // Optional: Add this if you want to handle deletion of media
  public function deleteMedia(string $mediaId): void
  {
    $media = $this->record->media()->find($mediaId);

    if ($media) {
      $media->delete();

      $this->notify('success', 'Media deleted successfully');
    }
  }
}
