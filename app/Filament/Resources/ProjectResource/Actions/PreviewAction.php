<?php

namespace App\Filament\Resources\ProjectResource\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class PreviewAction extends Action
{
  public static function make(?string $name = null): static
  {
    return parent::make($name)
      ->label('Preview')
      ->icon('heroicon-o-eye')
      ->url(fn (Model $record): string => route('projects.preview', $record))
      ->openUrlInNewTab();
  }
}
