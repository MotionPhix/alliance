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
    'view_count' => 'integer',
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
      ->singleFile()
      ->registerMediaConversions(function () {
        $this->addMediaConversion('thumb')
          ->width(200)
          ->height(200)
          ->sharpen(10);

        $this->addMediaConversion('featured')
          ->width(800)
          ->height(450)
          ->sharpen(10);
      });
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

  // Add scope for published posts
  public function scopePublished($query)
  {
    return $query->where('is_published', true)
      ->where('published_at', '<=', now());
  }

  // Add method to increment view count
  public function incrementViewCount()
  {
    $this->increment('view_count');
  }

  // Add method to check if post is liked by user
  public function isLikedBy($user)
  {
    return $this->likes()->where('user_id', $user->id)->exists();
  }

  // Add method to get reading time
  public function getReadingTimeAttribute()
  {
    $words = str_word_count(strip_tags($this->content));
    $minutes = ceil($words / 200);
    return $minutes;
  }

  public function tags()
  {
    return $this->morphToMany(Tag::class, 'taggable', 'taggables', null, 'tag_id')
      ->where('type', 'blog_tags');
  }

  public static function getTagClassName(): string
  {
    return Tag::class;
  }
}

