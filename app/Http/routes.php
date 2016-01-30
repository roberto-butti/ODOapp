<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

  Route::auth();
  Route::get('/', 'UserController@index');

  Route::get('/clips', 'ClipController@index');
  Route::post('/clip', 'ClipController@store');
  Route::delete('/clip/{clip}', 'ClipController@destroy');
  Route::delete('/api/clip/save', 'ClipController@save');

  Route::get('/u/{user}', 'UserController@userpage');

});

Route::group(['prefix' => 'i/user','middleware' => ['web']], function () {
  Route::get('/follow', 'ApiUserController@follow');
  Route::post('/unfollow', 'ApiUserController@unfollow');

});

