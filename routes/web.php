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

Route::any('/', 'HomeController@redirect');

Route::group([
        'prefix' => '{locale}', 
        'where' => ['locale' => 'en|hr'],
        'middleware' => 'locale'
    ], function() {

    // BLOG
    Route::any('/',                     'PostsController@index')->name('index');
    Route::get('/tag/{tag?}',           'PostsController@tagged')->name('posts.tagged');
    Route::get('/category/{category?}', 'PostsController@category')->name('posts.category');
    Route::resource('posts',            'PostsController');
});

// DASHBOARD
Route::get('/dashboard',                'HomeController@index')->name('dash.index')->middleware('auth');
Route::get('/dashboard/posts',          'HomeController@posts')->name('dash.posts')->middleware('auth');
Route::get('/dashboard/create',         'PostsController@create')->name('dash.create')->middleware('auth');

Route::post('/posts/visibility/{post?}','PostsController@visibility')->name('posts.visibility')->middleware('auth');

Route::prefix('dashboard')->group(function () {
    Route::resource('categories',       'CategoriesController')->middleware('auth');
    Route::resource('settings',         'SettingsController')->middleware('auth');
    Route::resource('users',            'UserController')->middleware('auth');
});

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

// SITEMAP
Route::get('/sitemap.xml',              'SitemapController@index');
Route::get('/sitemap.xml/posts',        'SitemapController@posts');
Route::get('/sitemap.xml/categories',   'SitemapController@categories');
Route::get('/sitemap.xml/tags',         'SitemapController@tags');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
