<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Filament\Resources\BlogPostResource\RelationManagers;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
        Forms\Components\TextInput::make('slug')
          ->required()
          ->maxLength(255),
        Forms\Components\Textarea::make('excerpt')
          ->required(),
        Forms\Components\RichEditor::make('content')
          ->required(),
        Forms\Components\FileUpload::make('image')
          ->image()
          ->directory('blog-images'),
        Forms\Components\DatePicker::make('published_at'),
        Forms\Components\Toggle::make('is_published')
          ->default(true),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table->columns([
        Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
        Tables\Columns\BooleanColumn::make('is_published'),
        Tables\Columns\TextColumn::make('published_at')->date(),
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
      'index' => Pages\ListBlogPosts::route('/'),
      'create' => Pages\CreateBlogPost::route('/create'),
      'edit' => Pages\EditBlogPost::route('/{record}/edit'),

    ];
  }
}
