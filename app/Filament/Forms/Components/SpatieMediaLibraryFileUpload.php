<?php

namespace App\Filament\Forms\Components;

use Closure;
use Filament\Forms\Components\FileUpload;
use Spatie\MediaLibrary\HasMedia;

class SpatieMediaLibraryFileUpload extends FileUpload
{
  protected string $collection = 'default';
  protected bool $shouldDeleteExisting = true;

  public function collection(string $collection): static
  {
    $this->collection = $collection;

    return $this;
  }

  public function preserveExisting(bool $shouldPreserve = true): static
  {
    $this->shouldDeleteExisting = !$shouldPreserve;

    return $this;
  }

  public function beforeStateDehydrated(?Closure $callback = null): static
  {
    if ($callback !== null) {
      return parent::beforeStateDehydrated($callback);
    }

    $record = $this->getRecord();

    if (! $record instanceof HasMedia) {
      return $this;
    }

    if ($this->shouldDeleteExisting) {
      $record->clearMediaCollection($this->collection);
    }

    if (blank($this->getState())) {
      return $this;
    }

    foreach ($this->getState() as $file) {
      $record->addMedia(storage_path('app/public/' . $file))
        ->toMediaCollection($this->collection);
    }

    return $this;
  }

  public function getState(): mixed
  {
    $state = parent::getState();

    if (blank($state)) {
      return null;
    }

    if (is_array($state)) {
      return $state;
    }

    return [$state];
  }
}
