<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/{userID?}', 'Api@getUsers');
Route::get('/blog_posts/{type?}/{typeID?}', 'Api@getPosts');
Route::post('/create_blog_post', 'Api@createPost');
Route::post('/edit_user/{userID}', 'Api@editUser');
