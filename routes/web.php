<?php

use Illuminate\Support\Facades\Route;

Route::get(
  '/',
  [\App\Http\Controllers\HomeController::class, 'index']
)->name('home');

Route::get(
  '/about',
  [\App\Http\Controllers\AboutController::class, 'index']
)->name('about');

Route::get(
  '/contact',
  [HomeController::class, 'contact']
)->name('contact');

Route::get(
  '/services',
  [HomeController::class, 'services']
)->name('services');

Route::prefix('blogs')->name('blogs.')->group(function () {

  Route::get(
    '/',
    [\App\Http\Controllers\BlogPostController::class, 'index']
  )->name('index');

  Route::get(
    '/{slug}',
    [\App\Http\Controllers\BlogPostController::class, 'show']
  )->name('show');

});
