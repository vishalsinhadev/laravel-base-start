<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessagingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/products', ProductController::class);

    Route::get('/chat', [MessagingController::class, 'index']);
    Route::post('/chat/conversation', [MessagingController::class, 'createConversation']);
    Route::get('/chat/conversation/{id}', [MessagingController::class, 'show']);
    Route::post('/chat/conversation/{id}/message', [MessagingController::class, 'send']);
});




require __DIR__ . '/auth.php';
