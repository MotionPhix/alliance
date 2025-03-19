<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
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
        Forms\Components\Tabs::make('Blog Post')
          ->tabs([
            Forms\Components\Tabs\Tab::make('Content')
              ->schema([
                Forms\Components\TextInput::make('title')
                  ->required()
                  ->maxLength(255)
                  ->live(onBlur: true)
                  ->afterStateUpdated(fn (string $state, Forms\Set $set) =>
                  $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                  ->required()
                  ->unique(ignoreRecord: true)
                  ->disabled(),

                TiptapEditor::make('content')
                  ->profile('simple')
                  ->disk('public')
                  ->directory('blog-content')
                  ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/gif'])
                  ->output(TiptapOutput::Html)
                  ->maxContentWidth('full')
                  ->columnSpanFull(),

                Forms\Components\Textarea::make('excerpt')
                  ->required()
                  ->rows(3)
                  ->maxLength(255)
                  ->columnSpanFull(),
              ])
              ->columns(2),

            Forms\Components\Tabs\Tab::make('Media')
              ->schema([
                SpatieMediaLibraryFileUpload::make('blog_images')
                  ->collection('blog_images')
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
                  ->columnSpanFull(),
              ]),

            Forms\Components\Tabs\Tab::make('Publishing')
              ->schema([
                Forms\Components\DateTimePicker::make('published_at')
                  ->label('Publish Date')
                  ->default(now()),

                Forms\Components\Toggle::make('is_published')
                  ->label('Published')
                  ->default(true),

                Forms\Components\Select::make('user_id')
                  ->label('Author')
                  ->relationship('user', 'name')
                  ->searchable()
                  ->required(),

                Forms\Components\SpatieTagsInput::make('tags')
                  ->type('blog_tags'),
              ]),
          ])
          ->columnSpanFull(),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        SpatieMediaLibraryImageColumn::make('Image')
          ->collection('blog_images')
          ->conversion('thumbnail')
          ->circular(false)
          ->square()
          ->defaultImageUrl(fn ($record) =>
          $record->hasMedia('blog_images')
            ? $record->getFirstMediaUrl('blog_images', 'thumbnail')
            : null
          ),

        Tables\Columns\TextColumn::make('title')
          ->searchable()
          ->sortable()
          ->limit(50),

        Tables\Columns\TextColumn::make('user.name')
          ->label('Author')
          ->sortable(),

        Tables\Columns\IconColumn::make('is_published')
          ->boolean()
          ->sortable(),

        Tables\Columns\TextColumn::make('published_at')
          ->dateTime()
          ->sortable(),

        Tables\Columns\TextColumn::make('view_count')
          ->label('Views')
          ->sortable(),
      ])
      ->filters([
        Tables\Filters\SelectFilter::make('user')
          ->relationship('user', 'name'),

        Tables\Filters\TernaryFilter::make('is_published')
          ->label('Published Status')
          ->indicator('Publication'),
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
}
