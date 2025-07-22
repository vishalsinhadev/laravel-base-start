<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\WelcomeController;

// Homepage
Route::get('/', [SiteController::class, 'index'])->name('site.index');

// Welcome page
Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');

// Check Post
Route::get('site/check-post/{prev}', [SiteController::class, 'checkPost'])->name('site.check-post');

// Contact Page
Route::get('/contact', [SiteController::class, 'contact'])->name('site.contact');
Route::post('/post-contact', [SiteController::class, 'postContact'])->name('submit-contact-form');

// Logout redirects to home (Not actual logout)
Route::get('/logout', function () {
    return Redirect::to('/');
});
