<?php

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
	
	// Authentication Routes...
	Route::get('login', 'Auth\AuthController@getLogin');
	Route::post('login', 'Auth\AuthController@postLogin');
	Route::get('logout', 'Auth\AuthController@getLogout');

	Route::group(['middleware' => ['auth']], function() {
	    //
	    Route::get('/', 'DashBoardController@index');
	    // Registration Routes...
		Route::get('register', 'Auth\AuthController@getRegister');
		Route::post('register', 'Auth\AuthController@postRegister');
		// Order
	    Route::resource('order', 'OrderController');
	});

});
