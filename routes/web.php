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
Route::get('/{category}/{url}/{id}', 'App\Http\Controllers\PostController@index');
Route::get('/category/{category}', 'App\Http\Controllers\CategoryController@index');
Route::get('/search', 'App\Http\Controllers\SearchController@index')->name('search');