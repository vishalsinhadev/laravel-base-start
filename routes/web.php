<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group([
    'middleware' => [
        'role:admin,user'
    ]
], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
    Route::get('/user/admin', 'UserController@admin')->name('user.admin');
    Route::get('/user/index', 'UserController@index')->name('user.index');
});