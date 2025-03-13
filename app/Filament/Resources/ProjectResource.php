<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
  protected static ?string $model = Project::class;

  protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

  protected static ?string $navigationGroup = 'Content';

  protected static ?int $navigationSort = 2;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\Card::make()
          ->schema([
            Forms\Components\TextInput::make('title')
              ->required()
              ->maxLength(255),

            Forms\Components\RichEditor::make('description')
              ->required()
              ->columnSpan('full'),

            Forms\Components\RichEditor::make('content')
              ->required()
              ->columnSpan('full'),

            Forms\Components\TextInput::make('funded_by')
              ->required()
              ->maxLength(255),

            Forms\Components\DatePicker::make('start_date')
              ->required(),

            Forms\Components\DatePicker::make('end_date'),

            Forms\Components\Select::make('status')
              ->options([
                'current' => 'Current',
                'completed' => 'Completed',
                'upcoming' => 'Upcoming',
              ])
              ->required(),

            SpatieTagsInput::make('tags')
              ->type('project')
              ->columnSpan('full'),

            Forms\Components\Repeater::make('key_achievements')
              ->schema([
                Forms\Components\TextInput::make('achievement')
                  ->required()
                  ->maxLength(255),
              ])
              ->collapsible()
              ->columnSpan('full'),

            Forms\Components\TextInput::make('people_reached')
              ->numeric()
              ->minValue(0),

            Forms\Components\TextInput::make('budget')
              ->numeric()
              ->prefix('MWK'),

            Forms\Components\KeyValue::make('meta_data')
              ->columnSpan('full'),

            Forms\Components\Toggle::make('is_featured')
              ->label('Feature this project')
              ->helperText('Featured projects will be displayed prominently on the website')
              ->columnSpan('full'),

            Forms\Components\TextInput::make('order')
              ->numeric()
              ->default(0)
              ->helperText('Lower numbers will be displayed first'),

            SpatieMediaLibraryFileUpload::make('project_image')
              ->collection('project_image')
              ->conversion('thumbnail')
              ->responsiveImages()
              ->image()
              ->imageEditor()
              ->columnSpan('full')
              //->loadStateFromRelationshipsUsing(fn ($component) => $component->state([]))
              ->saveRelationshipsUsing(fn ($component) => $component->saveUploadedFiles()),

            SpatieMediaLibraryFileUpload::make('project_gallery')
              ->collection('project_gallery')
              ->conversion('thumbnail')
              ->responsiveImages()
              ->multiple()
              ->image()
              ->imageEditor()
              ->maxFiles(5)
              ->columnSpan('full')
              ->panelLayout('grid')
              //->loadStateFromRelationshipsUsing(fn ($component) => $component->state([]))
              ->saveRelationshipsUsing(fn ($component) => $component->saveUploadedFiles()),
          ])
          ->columns(2),
      ])
      ->statePath('data')
      ->model(Project::class);
  }

  public function create(): void
  {
    $project = Project::create($this->form->getState());

    // Save the relationships from the form to the project after it is created.
    $this->form->model($project)->saveRelationships();
  }

  /*public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\ImageColumn::make('image')
          ->square(),
        Tables\Columns\TextColumn::make('name')
          ->searchable()
          ->sortable(),
        Tables\Columns\TextColumn::make('funded_by')
          ->searchable(),
        Tables\Columns\TextColumn::make('duration'),
        Tables\Columns\BooleanColumn::make('is_featured')
          ->trueIcon('heroicon-o-star')
          ->falseIcon('heroicon-o-x'),
        Tables\Columns\TextColumn::make('order')
          ->sortable(),
        Tables\Columns\TextColumn::make('updated_at')
          ->dateTime()
          ->sortable(),
      ])
      ->defaultSort('order', 'asc')
      ->filters([
        Tables\Filters\TernaryFilter::make('is_featured'),
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\DeleteBulkAction::make(),
      ])
      ->reorderable('order');
  }*/

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        SpatieMediaLibraryImageColumn::make('Image')
          ->collection('project_image')
          ->conversion('thumbnail'),
        Tables\Columns\TextColumn::make('title')
          ->searchable(['title', 'description', 'content'])
          ->sortable(),
        Tables\Columns\TextColumn::make('funded_by')
          ->searchable(),
        Tables\Columns\BadgeColumn::make('status')
          ->colors([
            'warning' => 'upcoming',
            'success' => 'current',
            'primary' => 'completed',
          ]),
        Tables\Columns\BooleanColumn::make('is_featured')
          ->trueIcon('heroicon-o-star')
          ->falseIcon('heroicon-o-x-mark'),
        Tables\Columns\TextColumn::make('updated_at')
          ->dateTime()
          ->sortable(),
      ])
      ->defaultSort('order', 'asc')
      ->filters([
        Tables\Filters\SelectFilter::make('status')
          ->options([
            'current' => 'Current',
            'completed' => 'Completed',
            'upcoming' => 'Upcoming',
          ])
          ->label('Project Status')
          ->indicator('Status'),
        Tables\Filters\TernaryFilter::make('is_featured')
          ->label('Featured Projects')
          ->indicator('Featured'),
      ])
      ->actions([
        Tables\Actions\ViewAction::make(),
        Tables\Actions\EditAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\DeleteBulkAction::make(),
      ])
      ->reorderable('order');
  }

  public static function getRelations(): array
  {
    return [
      // RelationManagers\MediaRelationManager::class
      // ProjectResource\RelationManagers\MediaRelationManager::class
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => Pages\ListProjects::route('/'),
      'create' => Pages\CreateProject::route('/create'),
      'edit' => Pages\EditProject::route('/{record}/edit'),
    ];
  }
}
