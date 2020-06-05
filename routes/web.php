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

// DASHBOARD
Route::get('/dashboard',                'HomeController@index')->name('home');
Route::get('/dashboard/posts',          'HomeController@posts')->name('dash.posts');
Route::get('/dashboard/create',         'PostsController@create')->name('posts.create');

// BLOG POSTS
Route::post('posts/visibility/{post?}', 'PostsController@visibility')->name('posts.visibility');
Route::resource('posts',                'PostsController');