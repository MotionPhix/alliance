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

