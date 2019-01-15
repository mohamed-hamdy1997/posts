<?php

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

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Storage;
use App\Post;

Auth::routes();

//user
Route::get('/adduser', 'UserController@viewAdd');
Route::post('/adduser', 'UserController@addUser');
Route::get('/users', 'UserController@index');
Route::get('users/{id}', 'UserController@destroy');
Route::get('user/{id}/posts', 'UserController@userPosts');
Route::get('editprofile/{id}', 'UserController@showUpdateProfilePage');
Route::post('editprofile/{id}', 'UserController@updateProfile');


//posts
Route::get('/', 'PostsController@index');

Route::resource('posts', 'PostsController');

Route::get('/create', 'PostsController@create');

Route::post('/create', 'PostsController@store');

Route::post('/posts/{id}', 'PostsController@update');

Route::get('/posts/{id}/view', 'PostsController@viewPost');

Route::get('/posts/{id}/destroy', 'PostsController@destroy');

Route::post('/posts/{id}/addComment', 'PostsController@addComment');

Route::get('/posts/{id}/destroyComment', 'PostsController@destroyComment');
