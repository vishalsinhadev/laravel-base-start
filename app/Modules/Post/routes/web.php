<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Post\Controllers\PostController;

Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
});
