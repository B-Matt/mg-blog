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

// AUTHORIZATION
Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', 'HomeController@index')->name('home');

// BLOG POSTS
Route::get('/posts/create', 'PostsController@create')->name('posts.create');
Route::post('/posts',       'PostsController@store')->name('posts.store');
Route::get('/posts',        'PostsController@index')->name('posts.index');
Route::get('/posts/{param}','PostsController@show')->name('posts.show');
