<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'slug',
    'excerpt',
    'content',
    'image',
    'published_at',
    'is_published'
  ];

  protected $casts = [
    'published_at' => 'date',
  ];
}
