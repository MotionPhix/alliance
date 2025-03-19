<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Tags\Tag as BaseTag;

class Tag extends BaseTag
{
  public function projects(): MorphToMany
  {
    return $this->morphedByMany(
      Project::class,
      'taggable',
      'taggables',
      'tag_id',
      'taggable_id'
    );
  }

  public function blogPosts(): MorphToMany
  {
    return $this->morphedByMany(
      BlogPost::class,
      'taggable',
      'taggables',
      'tag_id',
      'taggable_id'
    );
  }
}
