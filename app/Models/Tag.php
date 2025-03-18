<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Tags\Tag as SpatieTag;

class Tag extends SpatieTag
{
  /**
   * Get all blog posts that are tagged with this tag.
   */
  public function blogPosts(): MorphToMany
  {
    return $this->morphedByMany(BlogPost::class, 'taggable', 'taggables');
  }

  /**
   * Get the taggables relationship.
   */
  public function taggables(): MorphToMany
  {
    return $this->morphedByMany(BlogPost::class, 'taggable', 'taggables');
  }

  /**
   * Override the tag class name to use our custom Tag model.
   */
  public static function getTagClassName(): string
  {
    return static::class;
  }
}
