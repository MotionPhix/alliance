<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  protected $fillable = ['blog_post_id', 'user_id'];

  public function blogPost()
  {
    return $this->belongsTo(BlogPost::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
