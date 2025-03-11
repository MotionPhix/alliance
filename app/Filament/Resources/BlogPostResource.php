<?php

namespace App\Filament\Resources;

use App\Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Forms\Components\SpatieTagsInput;
use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class BlogPostResource extends Resource
{
  protected static ?string $model = BlogPost::class;

  protected static ?string $navigationIcon = 'heroicon-o-document-text';

  protected static ?string $navigationGroup = 'Content';

  protected static ?int $navigationSort = 1;

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\Group::make()
          ->schema([
            Forms\Components\Section::make('Main Content')
              ->schema([
                Forms\Components\TextInput::make('title')
                  ->required()
                  ->live(onBlur: true)
                  ->maxLength(255)
                  ->afterStateUpdated(fn (string $state, Forms\Set $set) =>
                  $set('slug', Str::slug($state))),

                Forms\Components\RichEditor::make('content')
                  ->required()
                  ->columnSpanFull(),
              ]),

            Forms\Components\Section::make('Image')
              ->schema([
                SpatieMediaLibraryFileUpload::make('blog_images')
                  ->collection('blog_images')
                  ->image()
                  ->imageEditor()
                  ->imageEditorAspectRatios([
                    '16:9',
                    '4:3',
                    '1:1',
                  ])
                  ->required(),
              ]),
          ])
          ->columnSpan(['lg' => 2]),

        Forms\Components\Group::make()
          ->schema([
            Forms\Components\Section::make('Meta')
              ->schema([
                Forms\Components\Textarea::make('excerpt')
                  ->required()
                  ->rows(4),

                SpatieTagsInput::make('tags')
                  ->type('blog_tags')
                  ->placeholder('Add tags...')
                  ->separator(','),
                  // ->suggestion(fn (string $state): string => Str::title($state)),

                Forms\Components\DatePicker::make('published_at')
                  ->label('Publish Date'),

                Forms\Components\Toggle::make('is_published')
                  ->label('Published')
                  ->default(true),

                Forms\Components\Select::make('user_id')
                  ->label('Author')
                  ->relationship('user', 'name')
                  ->searchable()
                  ->required(),
              ]),
          ])
          ->columnSpan(['lg' => 1]),
      ])
      ->model(BlogPost::class)
      ->columns(3);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\ImageColumn::make('blog_images')
          ->label('Image')
          ->circular(),

        Tables\Columns\TextColumn::make('title')
          ->searchable()
          ->sortable(),

        Tables\Columns\TextColumn::make('user.name')
          ->label('Author')
          ->sortable(),

        Tables\Columns\TagsColumn::make('tags.name')
          ->label('Tags'),

        Tables\Columns\IconColumn::make('is_published')
          ->boolean()
          ->sortable(),

        Tables\Columns\TextColumn::make('published_at')
          ->date()
          ->sortable(),
      ])
      ->filters([
        Tables\Filters\SelectFilter::make('user')
          ->relationship('user', 'name'),

        Tables\Filters\Filter::make('published')
          ->query(fn (Builder $query): Builder => $query->where('is_published', true)),

        Tables\Filters\Filter::make('unpublished')
          ->query(fn (Builder $query): Builder => $query->where('is_published', false)),
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make(),
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
      'index' => Pages\ListBlogPosts::route('/'),
      'create' => Pages\CreateBlogPost::route('/create'),
      'edit' => Pages\EditBlogPost::route('/{record}/edit'),
    ];
  }

  public static function getNavigationBadge(): ?string
  {
    return static::getModel()::count();
  }
}
