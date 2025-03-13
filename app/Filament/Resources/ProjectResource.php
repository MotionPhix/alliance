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
        Forms\Components\Tabs::make('Project')
          ->tabs([
            Forms\Components\Tabs\Tab::make('Basic Information')
              ->schema([
                Forms\Components\TextInput::make('title')
                  ->required()
                  ->maxLength(255)
                  ->columnSpan('full'),

                Forms\Components\RichEditor::make('description')
                  ->required()
                  ->toolbarButtons([
                    'bold',
                    'italic',
                    'link',
                    'bulletList',
                    'orderedList',
                  ])
                  ->columnSpan('full'),

                Forms\Components\RichEditor::make('content')
                  ->required()
                  ->toolbarButtons([
                    'bold',
                    'italic',
                    'link',
                    'bulletList',
                    'orderedList',
                    'blockquote',
                    'h2',
                    'h3',
                  ])
                  ->columnSpan('full'),

                Forms\Components\Grid::make(2)
                  ->schema([
                    Forms\Components\TextInput::make('funded_by')
                      ->required()
                      ->maxLength(255),

                    Forms\Components\Select::make('status')
                      ->options([
                        'current' => 'Current',
                        'completed' => 'Completed',
                        'upcoming' => 'Upcoming',
                      ])
                      ->required(),

                    Forms\Components\DatePicker::make('start_date')
                      ->required(),

                    Forms\Components\DatePicker::make('end_date'),
                  ]),
              ]),

            Forms\Components\Tabs\Tab::make('Media')
              ->schema([
                SpatieMediaLibraryFileUpload::make('project_image')
                  ->collection('project_image')
                  ->image()
                  ->imageEditor()
                  ->imageEditorMode(2)
                  ->downloadable()
                  ->openable()
                  ->preserveFilenames()
                  ->previewable(true)
                  ->imageCropAspectRatio('16:9')
                  ->imageResizeTargetWidth('1920')
                  ->imageResizeTargetHeight('1080')
                  ->helperText('Recommended size: 1920x1080px. Will be used as the hero image.')
                  ->columnSpan('full'),

                SpatieMediaLibraryFileUpload::make('project_gallery')
                  ->collection('project_gallery')
                  ->multiple()
                  ->image()
                  ->imageEditor()
                  ->imageEditorMode(2)
                  ->downloadable()
                  ->openable()
                  ->preserveFilenames()
                  ->previewable(true)
                  ->reorderable()
                  ->maxFiles(5)
                  ->imageCropAspectRatio('16:9')
                  ->imageResizeTargetWidth('800')
                  ->imageResizeTargetHeight('600')
                  ->helperText('Up to 5 images. Recommended size: 800x600px')
                  ->columnSpan('full'),
              ]),

            Forms\Components\Tabs\Tab::make('Additional Information')
              ->schema([
                SpatieTagsInput::make('tags')
                  ->type('project')
                  ->suggestions(['community', 'education', 'health', 'environment'])
                  ->columnSpan('full'),

                Forms\Components\Repeater::make('key_achievements')
                  ->schema([
                    Forms\Components\TextInput::make('achievement')
                      ->required()
                      ->maxLength(255),
                  ])
                  ->collapsible()
                  ->itemLabel(fn (array $state): ?string => $state['achievement'] ?? null)
                  ->columnSpan('full'),

                Forms\Components\Grid::make(2)
                  ->schema([
                    Forms\Components\TextInput::make('people_reached')
                      ->numeric()
                      ->minValue(0)
                      ->suffix('people'),

                    Forms\Components\TextInput::make('budget')
                      ->numeric()
                      ->prefix('MWK')
                      ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->thousandsSeparator(',')
                        ->decimalPlaces(2)
                      ),
                  ]),

                Forms\Components\KeyValue::make('meta_data')
                  ->columnSpan('full')
                  ->keyLabel('Metric Name')
                  ->valueLabel('Value')
                  ->reorderable(),
              ]),

            Forms\Components\Tabs\Tab::make('Display Options')
              ->schema([
                Forms\Components\Toggle::make('is_featured')
                  ->label('Feature this project')
                  ->helperText('Featured projects will be displayed prominently on the website')
                  ->columnSpan('full'),

                Forms\Components\TextInput::make('order')
                  ->numeric()
                  ->default(0)
                  ->helperText('Lower numbers will be displayed first'),
              ]),
          ])
          ->columnSpan('full'),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        SpatieMediaLibraryImageColumn::make('Image')
          ->collection('project_image')
          ->conversion('thumbnail')
          ->circular(false)
          ->square()
          ->defaultImageUrl(fn ($record) =>
          $record->hasMedia('project_image')
            ? $record->getFirstMediaUrl('project_image', 'thumbnail')
            : null
          ),

        Tables\Columns\TextColumn::make('title')
          ->searchable(['title', 'description', 'content'])
          ->sortable()
          ->wrap(),

        Tables\Columns\TextColumn::make('funded_by')
          ->searchable()
          ->toggleable(),

        Tables\Columns\BadgeColumn::make('status')
          ->colors([
            'warning' => 'upcoming',
            'success' => 'current',
            'primary' => 'completed',
          ])
          ->icons([
            'heroicon-o-clock' => 'upcoming',
            'heroicon-o-play' => 'current',
            'heroicon-o-check' => 'completed',
          ]),

        Tables\Columns\IconColumn::make('is_featured')
          ->boolean()
          ->trueIcon('heroicon-o-star')
          ->falseIcon('heroicon-o-x-mark')
          ->toggleable(),

        Tables\Columns\TextColumn::make('updated_at')
          ->dateTime()
          ->sortable()
          ->toggleable(),
      ])
      ->defaultSort('order', 'asc')
      ->filters([
        Tables\Filters\SelectFilter::make('status')
          ->multiple()
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
        Tables\Actions\DeleteBulkAction::make()
          ->requiresConfirmation(),
      ])
      ->reorderable('order')
      ->defaultPaginationPageOption(25);
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
