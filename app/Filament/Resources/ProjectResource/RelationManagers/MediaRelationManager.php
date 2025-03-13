<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class MediaRelationManager extends RelationManager
{
  protected static string $relationship = 'media';

  protected static ?string $title = 'Images';

  protected static ?string $modelLabel = 'Images';

  public function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\Hidden::make('id'),
        Forms\Components\ViewField::make('file_name')
          ->label('Image Preview')
          ->disabled()
          ->view('filament.forms.components.image-preview')
          ->afterStateHydrated(function ($component, $get, $state) {
            $component->state(Storage::url($get('id') . '/' . $state));
          })
          ->dehydrated(false),
        Forms\Components\TextInput::make('name')
          ->required()
          ->maxLength(255)
          ->columnSpan('full'),
      ]);
  }

  public function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\ImageColumn::make('file_name')
          ->label('Poster')
          ->getStateUsing(function ($record) {
            return $record->getFullUrl();
          }),
        Tables\Columns\TextColumn::make('name'),
      ])
      ->filters([
        //
      ])
      ->headerActions([
        Tables\Actions\CreateAction::make(),
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
          Tables\Actions\DeleteBulkAction::make(),
        ]),
      ])
      ->reorderable('order_column')
      ->defaultSort('order_column');
  }
}
