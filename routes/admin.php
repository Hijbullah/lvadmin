<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    return 'hello';
});

// Admin Auth Routes

Route::namespace('Backend\Auth')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout')->name('admin.logout');
});

Route::get('/', 'Backend\AdminController@index')->name('admin.dashboard');

