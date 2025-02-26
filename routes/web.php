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
  '/contact-us',
  [\App\Http\Controllers\ContactController::class, 'index']
)->name('contact');

Route::get(
  '/projects',
  [\App\Http\Controllers\ProjectController::class, 'index']
)->name('projects');

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

Route::prefix('donate')->name('donation.')->group(function () {

  Route::get(
    '/',
    [\App\Http\Controllers\DonationController::class, 'showDonationForm']
  )->name('form');

  Route::post(
    '/process',
    [\App\Http\Controllers\DonationController::class, 'processDonation']
  )->name('process');

  Route::get(
    '/success',
    [\App\Http\Controllers\DonationController::class, 'donationSuccess']
  )->name('success');

  Route::get(
    '/cancel',
    [\App\Http\Controllers\DonationController::class, 'donationCancel']
  )->name('cancel');

  Route::post(
    '/callback',
    [\App\Http\Controllers\DonationController::class, 'donationCallback']
  )->name('callback');

});
