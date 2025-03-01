<?php

namespace App\Filament\Resources;

use App\Filament\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Forms\Components\SpatieTagsInput;
use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BlogPostResource extends Resource
{
  protected static ?string $model = BlogPost::class;

  protected static ?string $navigationIcon = 'heroicon-o-document-text';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('title')
          ->required()
          ->maxLength(255),
        Forms\Components\Textarea::make('excerpt')
          ->required(),
        Forms\Components\RichEditor::make('content')
          ->required(),
        Forms\Components\DatePicker::make('published_at'),
        Forms\Components\Toggle::make('is_published')
          ->default(true),
        Forms\Components\Select::make('user_id')
          ->label('Author')
          ->relationship('user', 'name') // Display user's name
          ->required(),
        SpatieTagsInput::make('tags')
          ->type('blog_tags'),
        SpatieMediaLibraryFileUpload::make('blog_images')
          ->collection('blog_images')
          ->image()
          ->required(),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table->columns([
      Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
      Tables\Columns\TextColumn::make('user.name')->label('Author')->sortable(),
      Tables\Columns\BooleanColumn::make('is_published'),
      Tables\Columns\TextColumn::make('published_at')->date(),
      Tables\Columns\TagsColumn::make('tags.name'),
    ])
      ->filters([
        Tables\Filters\Filter::make('published')
          ->query(fn ($query) => $query->where('is_published', true)),
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
      'index' => Pages\ListBlogPosts::route('/'),
      'create' => Pages\CreateBlogPost::route('/create'),
      'edit' => Pages\EditBlogPost::route('/{record}/edit'),
    ];
  }
}
