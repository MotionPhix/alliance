<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpactMetric extends Model
{
  use HasFactory;

  protected $fillable = [
    'icon',
    'title',
    'metric',
    'description',
    'sort_order',
    'is_published'
  ];
}
