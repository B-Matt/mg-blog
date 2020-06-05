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
//Route::get('/dashboard/edit/{param}',   'PostsController@edit')->name('posts.edit');
//Route::post('/dashboard/edit',          'PostsController@update')->name('posts.update');

// BLOG POSTS
Route::resource('posts',                'PostsController');
/*Route::post('/posts',                   'PostsController@store')->name('posts.store');
Route::get('/posts',                    'PostsController@index')->name('posts.index');
Route::get('/posts/{param}',            'PostsController@show')->name('posts.show');*/