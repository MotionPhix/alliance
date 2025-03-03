<?php

namespace App\Filament\Forms\Components;

use Closure;
use Filament\Forms\Components\FileUpload;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SpatieMediaLibraryFileUpload extends FileUpload
{
  protected string $collection = 'default';
  protected bool $shouldDeleteExisting = true;
  protected ?string $conversionName = null;
  protected bool $withResponsiveImages = false;
  protected array $customProperties = [];

  public function collection(string $collection): static
  {
    $this->collection = $collection;

    return $this;
  }

  public function conversion(?string $conversionName): static
  {
    $this->conversionName = $conversionName;

    return $this;
  }

  public function withResponsiveImages(bool $condition = true): static
  {
    $this->withResponsiveImages = $condition;

    return $this;
  }

  public function preserveExisting(bool $shouldPreserve = true): static
  {
    $this->shouldDeleteExisting = !$shouldPreserve;

    return $this;
  }

  public function customProperties(array $properties): static
  {
    $this->customProperties = $properties;

    return $this;
  }

  protected function setUp(): void
  {
    parent::setUp();

    $this->loadStateFromRelationshipsUsing(static function (SpatieMediaLibraryFileUpload $component) {
      $record = $component->getRecord();

      if (! $record instanceof HasMedia) {
        return;
      }

      $media = $record->getMedia($component->collection);

      if (! $component->isMultiple()) {
        $media = $media->first();
      }

      if (blank($media)) {
        return null;
      }

      if (! $component->isMultiple()) {
        return $media->getUrl($component->conversionName);
      }

      return $media->map(fn (Media $media): string => $media->getUrl($component->conversionName))->all();
    });
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
      $media = $record->addMedia(storage_path('app/public/' . $file))
        ->withCustomProperties($this->customProperties);

      if ($this->withResponsiveImages) {
        $media->withResponsiveImages();
      }

      $media->toMediaCollection($this->collection);
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
