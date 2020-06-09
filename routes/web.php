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
//Auth::routes();
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/',                         'PostsController@index');
Route::get('/dashboard',                'HomeController@index')->name('dash.index');
Route::get('/dashboard/posts',          'HomeController@posts')->name('dash.posts');
Route::get('/dashboard/create',         'PostsController@create')->name('dash.create');
Route::post('/posts/visibility/{post?}','PostsController@visibility')->name('posts.visibility');

Route::resource('posts',                'PostsController');

Route::prefix('dashboard')->group(function () {
    Route::resource('settings',             'SettingsController');
    Route::resource('users',                'UserController');
});