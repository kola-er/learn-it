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

/**----------Landing page route----------**/
Route::get('/', 'ViewController@index');

/**----------Registration route----------**/
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

/**----------Login route----------**/
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');

/**----------Social authentication route----------**/
Route::get('login/{provider}', 'Auth\AuthController@socialLogin');

/**----------Homepage route----------**/
Route::get('dashboard', 'ViewController@dashboard')->middleware(['auth.check']);

/**----------Profile update route----------**/
Route::get('update-profile', 'ProfileController@editProfile')->middleware(['auth.check']);
Route::post('update-profile', 'ProfileController@updateProfile');

/**----------Video post route--------------**/
Route::post('video-post', 'VideoController@store')->middleware(['auth.check']);

/**----------Logout route----------**/
Route::get('logout', 'Auth\AuthController@getLogout');

/**----------Category video route----------**/
Route::get('/{categoryId}', 'ViewController@index');