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

Route::get('/','PostsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('posts', 'PostsController');
Route::get('category/{id}/{slug}', 'PostsController@getByCategory')->name('get.post.by.cat');
Route::post('posts/search', 'PostsController@search')->name('posts.search');



Route::resource('comment', 'CommentsController');

/* Route::resource('user', 'ProfileController'); */
Route::get('user/{id}','ProfileController@getByUser')->name('profile'); 
Route::get('user/{id}/comments','ProfileController@getCommentsByUser')->name('user_comments'); 
Route::get('settings','ProfileController@settings')->name('settings'); 
Route::post('settings','ProfileController@updateProfile')->name('settings'); 

//admin url
Route::group(['prefix' => 'admin','middleware'=>'admin'], function () {
    Route::get('dashboard','admin\DashboardController@index')->name('dashboard');
    Route::resource('post', 'admin\PostsController');
    Route::resource('page', 'admin\PageController');
    Route::get('permission', 'admin\permissionController@index')->name('permissions');
    Route::post('permission', 'admin\RoleController@store')->name('permissions');
    Route::resource('category', 'CategoriesController');
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
});

Route::post('permissionbyrole','admin\RoleController@getByRole')->name('Permission.by.role');
