<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

  Route::post(
    'like/blog/{post}',
    [\App\Http\Controllers\LikeController::class, 'toggle']
  )->name('api.toggle-like');

});
