<?php

namespace App\Filament\Widgets;

use App\Models\BlogPost;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestBlogPosts extends BaseWidget
{
  protected static ?int $sort = 2;
  protected int | string | array $columnSpan = 'full';

  public function table(Table $table): Table
  {
    return $table
      ->query(
        BlogPost::query()
          ->latest('published_at')
          ->limit(5)
      )
      ->columns([
        Tables\Columns\TextColumn::make('title')
          ->searchable()
          ->limit(40),
        Tables\Columns\TextColumn::make('published_at')
          ->dateTime()
          ->sortable(),
        Tables\Columns\IconColumn::make('is_published')
          ->boolean(),
        Tables\Columns\TextColumn::make('view_count')
          ->label('Views')
          ->sortable(),
        Tables\Columns\TextColumn::make('user.name')
          ->label('Author'),
      ])
      ->heading('Latest Blog Posts')
      ->contentGrid([
        'md' => 2,
        'xl' => 3,
      ]);
  }
}
