<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImpactMetricResource\Pages;
use App\Filament\Resources\ImpactMetricResource\RelationManagers;
use App\Models\ImpactMetric;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ImpactMetricResource extends Resource
{
  protected static ?string $model = ImpactMetric::class;

  protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('title')
          ->required()
          ->maxLength(255),
        Forms\Components\TextInput::make('metric')
          ->required()
          ->maxLength(255),
        Forms\Components\Textarea::make('description')
          ->required(),
        Forms\Components\FileUpload::make('icon')
          ->image()
          ->directory('metric-icons'),
        Forms\Components\Toggle::make('is_published')
          ->default(true),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
        Tables\Columns\TextColumn::make('metric'),
        Tables\Columns\BooleanColumn::make('is_published'),
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
      'index' => Pages\ListImpactMetrics::route('/'),
      'create' => Pages\CreateImpactMetric::route('/create'),
      'edit' => Pages\EditImpactMetric::route('/{record}/edit'),
    ];
  }
}
