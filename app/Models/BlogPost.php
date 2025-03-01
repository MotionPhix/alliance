<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;

class BlogPost extends Model implements HasMedia
{
  use HasFactory, HasSlug, InteractsWithMedia, HasTags;

  protected $fillable = [
    'title',
    'slug',
    'excerpt',
    'content',
    'published_at',
    'is_published',
    'user_id',
  ];

  protected $casts = [
    'published_at' => 'date',
    'is_published' => 'boolean',
  ];

  // Spatie Sluggable
  public function getSlugOptions(): SlugOptions
  {
    return SlugOptions::create()
      ->generateSlugsFrom('title')
      ->saveSlugsTo('slug');
  }

  // Spatie Media Library
  public function registerMediaCollections(): void
  {
    $this->addMediaCollection('blog_images')
      ->singleFile(); // Only one image per blog post
  }

  // Relationship to User (Author/Publisher/Owner)
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  public function likes()
  {
    return $this->hasMany(Like::class);
  }
}
