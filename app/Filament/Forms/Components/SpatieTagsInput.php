<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;
use Spatie\Tags\Tag;

class SpatieTagsInput extends Field
{
  protected string $view = 'filament.forms.components.spatie-tags-input';

  protected string $type = 'default';

  public function type(string $type): static
  {
    $this->type = $type;
    return $this;
  }

  public function getTags(): array
  {
    return Tag::query()
      ->where('type', $this->type)
      ->pluck('name')
      ->toArray();
  }

  public function getViewData(): array
  {
    return array_merge(parent::getViewData(), [
      'tags' => $this->getTags(),
    ]);
  }
}
