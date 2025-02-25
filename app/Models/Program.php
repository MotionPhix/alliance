<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'slug',
    'description',
    'icon',
    'image',
    'objectives',
    'achievements',
    'sort_order',
    'is_published'
  ];
}
