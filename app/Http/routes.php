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

Route::get('/', 'LearnController@index');

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');

Route::get('logout', 'Auth\AuthController@getLogout');

Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

Route::get('dashboard', 'LearnController@dashboard')->middleware(['auth.check']);

Route::get('login/{provider}', 'Auth\AuthController@socialLogin');

Route::get('initial-password', 'AccountUpdateController@registerPassword')->middleware(['auth', 'auth.check']);
Route::post('initial-password', 'AccountUpdateController@registerPassword')->middleware(['auth', 'auth.check']);

Route::get('update-profile', 'AccountUpdateController@editProfile')->middleware(['auth', 'auth.check']);