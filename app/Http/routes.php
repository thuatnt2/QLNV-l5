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
    // Route::auth();
    // // Authentication Routes...
	Route::get('login', 'Auth\AuthController@showLoginForm');
	Route::post('login', 'Auth\AuthController@login');
	Route::get('logout', 'Auth\AuthController@logout');

	Route::group(['middleware' => ['auth']], function() {
	    //
	    Route::get('/', 'DashBoardController@index');
	    // Registration Routes...
		Route::get('register', 'Auth\AuthController@getRegister');
		// Route::post('register', 'Auth\AuthController@postRegister');
		// Orders
	    Route::resource('orders', 'OrderController');
	    Route::post('import/order', ['as' => 'import.order', 'uses' => 'OrderController@importExcel']);
	    Route::post('import/news', ['as' => 'import.news', 'uses' => 'NewsController@importExcel']);
	    Route::post('import/ship', ['as' => 'import.ship', 'uses' => 'ShipController@importExcel']);
	    Route::post('import/xmctb', ['as' => 'import.xmctb', 'uses' => 'XMCTBController@importExcel']);
	    Route::post('import/imei', ['as' => 'import.imei', 'uses' => 'ImeiController@importExcel']);
	    // Route::get('edit-list/{id}', ['as' => 'order.edit-list', 'uses' => 'OrderController@editList']);
	    Route::post('update-status/{id}', ['as' => 'update.status', 'uses' => 'OrderController@updateStatus']);
	    Route::get('search', ['as' => 'search', 'uses' => 'OrderController@search']);
	    Route::get('file/{folder}/{filename}', ['as' => 'file', 'uses' => 'OrderController@readFile']);
	    // Orders
	    Route::resource('statistics', 'StatisticController');
	    Route::get('statistics/export/excel',['as' => 'excel', 'uses' => 'StatisticController@exportExcel']);
	    // Route::get('statistics/export/pdf',['as' => 'pdf', 'uses' => 'StatisticController@exportPdf']);
        // Units
        Route::resource('units', 'UnitController');
        // category
        Route::resource('categories', 'CategoryController');
        // kind
        Route::resource('kinds', 'KindController');
        // ship_lists
        Route::resource('ship/list', 'ShipController');
        // ship_news
        Route::resource('ship/news', 'NewsController');
        // ship_news
        Route::resource('ship/xmctb', 'XMCTBController');
        // ship_news
        Route::resource('ship/imei', 'ImeiController');
	});

});

