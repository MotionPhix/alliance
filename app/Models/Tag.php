<?php

namespace App\Models;

use Spatie\Tags\Tag as SpatieTag;

class Tag extends SpatieTag
{
  public function blogPosts()
  {
    return $this->morphedByMany(BlogPost::class, 'taggable');
  }

  public static function getTagClassName(): string
  {
    return Tag::class;
  }
}
