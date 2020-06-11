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
Route::get('login', [
'as' => 'login',
'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
'as' => '',
'uses' => 'Auth\LoginController@login'
]);
Route::post('logout', [
'as' => 'logout',
'uses' => 'Auth\LoginController@logout'
]);
//Auth::routes();

// APP
Route::any('/',                         'PostsController@index')->name('index');
Route::get('/dashboard',                'HomeController@index')->name('dash.index');
Route::get('/dashboard/posts',          'HomeController@posts')->name('dash.posts');
Route::get('/dashboard/create',         'PostsController@create')->name('dash.create');
Route::post('/posts/visibility/{post?}','PostsController@visibility')->name('posts.visibility');
Route::get('/posts/tag/{tag?}',      'PostsController@tagged')->name('posts.tagged');

Route::resource('posts',                'PostsController');

Route::prefix('dashboard')->group(function () {
    Route::resource('settings',             'SettingsController');
    Route::resource('users',                'UserController');
});