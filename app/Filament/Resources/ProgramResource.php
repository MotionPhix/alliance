<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProgramResource extends Resource
{
  protected static ?string $model = Program::class;

  protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-ripple';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('title')
          ->required()
          ->maxLength(255),
        Forms\Components\TextInput::make('slug')
          ->required()
          ->maxLength(255),
        Forms\Components\Textarea::make('description')
          ->required(),
        Forms\Components\FileUpload::make('icon')
          ->image()
          ->directory('program-icons'),
        Forms\Components\FileUpload::make('image')
          ->image()
          ->directory('program-images'),
        Forms\Components\Textarea::make('objectives'),
        Forms\Components\Textarea::make('achievements'),
        Forms\Components\Toggle::make('is_published')
          ->default(true),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
        Tables\Columns\BooleanColumn::make('is_published'),
        Tables\Columns\TextColumn::make('created_at')->dateTime(),
      ])
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
          Tables\Actions\DeleteBulkAction::make(),
        ]),
      ]);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => Pages\ListPrograms::route('/'),
      'create' => Pages\CreateProgram::route('/create'),
      'edit' => Pages\EditProgram::route('/{record}/edit'),
    ];
  }
}
