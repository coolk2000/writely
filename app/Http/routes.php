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

Route::get('/', function()
{
	return redirect('home');
});

Route::get('home', 'PagesController@index');
Route::resource('pages', 'PagesController');
Route::get('user/settings', 'UsersController@settings');
Route::get('user/{user}', 'UsersController@show');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);