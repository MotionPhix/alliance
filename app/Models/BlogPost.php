<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
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
        'view_count',
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_published' => 'boolean',
        'view_count' => 'integer',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        if ($media === null) {
            return;
        }

        $this->addMediaConversion('thumbnail')
            ->fit(Fit::Crop, 400, 300)
            ->nonQueued();

        $this->addMediaConversion('preview')
            ->fit(Fit::Contain, 800, 600)
            ->nonQueued();

        $this->addMediaConversion('hero')
            ->fit(Fit::Max, 1200, 675)
            ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('blog_images')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->withResponsiveImages();
    }

    // Helper method to get the featured image URL with different sizes
    public function getFeaturedImageAttribute()
    {
        if (!$this->hasMedia('blog_images')) {
            return null;
        }

        return [
            'thumbnail' => $this->getFirstMediaUrl('blog_images', 'thumbnail'),
            'preview' => $this->getFirstMediaUrl('blog_images', 'preview'),
            'hero' => $this->getFirstMediaUrl('blog_images', 'hero'),
            'original' => $this->getFirstMediaUrl('blog_images'),
        ];
    }

    // Relationship to User (Author)
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
        return ceil($words / 200);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')
            ->where('type', 'blog_tags');
    }
}
