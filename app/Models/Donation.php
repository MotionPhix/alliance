<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'email',
    'amount',
    'currency',
    'paychangu_transaction_id',
    'status'
  ];
}
