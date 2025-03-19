<?php

namespace App\Filament\Resources\BlogPostResource\Pages;

use App\Filament\Resources\BlogPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlogPost extends EditRecord
{
  protected static string $resource = BlogPostResource::class;

  protected function getHeaderActions(): array
  {
    return [
      Actions\DeleteAction::make(),
    ];
  }

  protected function afterSave(): void
  {
    // Refresh the record to get the latest media
    $this->record->refresh();
  }

  public function deleteMedia(string $mediaId): void
  {
    $media = $this->record->media()->find($mediaId);

    if ($media) {
      $media->delete();

      $this->notify('success', 'Media deleted successfully');
    }
  }
}
