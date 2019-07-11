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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'is_authorized']], function() {
	Route::post('/', 'UserController@store');
	Route::get('/showAll', 'UserController@showAll');
	Route::get('/{user}', 'UserController@show');
	Route::put('/{user}', 'UserController@update');
});
