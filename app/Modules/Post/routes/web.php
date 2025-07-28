<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Post\Controllers\PostController;

Route::resource('posts', PostController::class);
