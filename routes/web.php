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

Route::get('/dashboard',                'HomeController@index')->name('dash.index');
Route::get('/dashboard/posts',          'HomeController@posts')->name('dash.posts');
Route::get('/dashboard/create',         'PostsController@create')->name('posts.create');
Route::get('/dashboard/users',          'UserController@index')->name('users.index');

Route::post('posts/visibility/{post?}', 'PostsController@visibility')->name('posts.visibility');
Route::resource('posts',                'PostsController');
Route::resource('users',                'UserController');