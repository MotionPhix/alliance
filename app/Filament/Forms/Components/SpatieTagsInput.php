<?php

namespace App\Filament\Forms\Components;

use Closure;
use Filament\Forms\Components\TagsInput;

class SpatieTagsInput extends TagsInput
{
  protected ?string $type = null;

  public function type(string $type): static
  {
    $this->type = $type;

    return $this;
  }

  public function dehydrateState(array &$state, bool $isDehydrated = true): void
  {
    parent::dehydrateState($state, $isDehydrated);
  }

  public function afterStateHydrated(?Closure $callback = null): static
  {
    if ($callback !== null) {
      return parent::afterStateHydrated($callback);
    }

    $record = $this->getRecord();

    if (! $record) {
      return $this;
    }

    $this->state($record->tags->where('type', $this->type)->pluck('name')->toArray());

    return $this;
  }

  public function beforeStateDehydrated(?Closure $callback = null): static
  {
    if ($callback !== null) {
      return parent::beforeStateDehydrated($callback);
    }

    $record = $this->getRecord();

    if (! $record) {
      return $this;
    }

    $tags = $this->getState() ?? [];

    if ($this->type) {
      $record->syncTagsWithType($tags, $this->type);
    } else {
      $record->syncTags($tags);
    }

    return $this;
  }
}
