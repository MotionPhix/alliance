<?php

namespace App\Filament\Resources\BlogPostResource\Pages;

use App\Filament\Resources\BlogPostResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateBlogPost extends CreateRecord
{
  protected static string $resource = BlogPostResource::class;

  protected function mutateFormDataBeforeCreate(array $data): array
  {
    $data['user_id'] = Auth::id();
    $data['view_count'] = 0;

    if (!isset($data['published_at'])) {
      $data['published_at'] = now();
    }

    return $data;
  }

  protected function getRedirectUrl(): string
  {
    return $this->getResource()::getUrl('index');
  }
}
