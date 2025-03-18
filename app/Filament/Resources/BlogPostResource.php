<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content';

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
                                    ->afterStateUpdated(fn(string $state, Forms\Set $set) =>
                                        $set('slug', Str::slug($state))),

                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),

                                Forms\Components\Textarea::make('excerpt')
                                    ->required()
                                    ->rows(3)
                                    ->maxLength(255),

                                Forms\Components\RichEditor::make('content')
                                    ->required()
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Forms\Components\Section::make('Featured Image')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('blog_images')
                                    ->collection('blog_images')
                                    ->image()
                                    ->imageEditor()
                                    ->preserveFilenames()
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Publishing')
                            ->schema([
                                Forms\Components\DatePicker::make('published_at')
                                    ->label('Publish Date'),

                                Forms\Components\Toggle::make('is_published')
                                    ->label('Published')
                                    ->default(true),

                                    Forms\Components\Select::make('user_id')
                                    ->label('Author')
                                    ->relationship(name: 'user', titleAttribute: 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),

                                SpatieTagsInput::make('tags')
                                    ->type('blog_tags'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('Image')
                    ->collection('blog_images')
                    ->conversion('thumbnail')
                    ->square(),

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
                    ->date()
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
