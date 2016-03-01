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
	
	//Authentication Routes...
    Route::auth();

	Route::group(['middleware' => ['auth']], function() {
	    //
	    Route::get('/', 'DashBoardController@index');
	    // Registration Routes...
		Route::get('register', 'Auth\AuthController@getRegister');
		Route::post('register', 'Auth\AuthController@postRegister');
		// Orders
	    Route::resource('orders', 'OrderController');
	    Route::get('order-list', ['as' => 'order.list', 'uses' => 'OrderController@orderList']);
	    Route::get('edit-list/{id}', ['as' => 'order.edit-list', 'uses' => 'OrderController@editList']);
	    Route::post('update-status/{id}', ['as' => 'update.status', 'uses' => 'OrderController@updateStatus']);
	    Route::get('search', ['as' => 'search', 'uses' => 'OrderController@search']);
	    // Orders
	    Route::resource('statistics', 'StatisticController');
        // Units
        Route::resource('units', 'UnitController');
        // category
        Route::resource('categories', 'CategoryController');
        // kind
        Route::resource('kinds', 'KindController');
        // ship_lists
        Route::resource('ships', 'ShipController');
        // ship_news
        Route::resource('news', 'NewsController');
	});

});

Route::group(['middleware' => 'web'], function () {
   

    Route::get('/home', 'HomeController@index');
});
