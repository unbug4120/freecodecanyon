<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\IndexController@index');
Route::post('/report', 'App\Http\Controllers\PostController@store')->name('posts.store');
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/report', 'App\Http\Controllers\PostController@index');
Route::get('/scrap_post', 'App\Http\Controllers\PostController@scrap_post');
Route::get('/scrap', 'App\Http\Controllers\PostController@scrap');