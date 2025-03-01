<?php

namespace App\Filament\Components;

use Filament\Forms\Components\FileUpload;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SpatieMediaLibraryFileUpload extends FileUpload
{
  protected string $collection = 'default';

  public function collection(string $collection): static
  {
    $this->collection = $collection;
    return $this;
  }

  public function getMedia(): array
  {
    return Media::query()
      ->where('collection_name', $this->collection)
      ->pluck('file_name')
      ->toArray();
  }
}
