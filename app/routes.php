<?php

Route::group(["namespace" => "Controllers"], function(){

    /**
     * Front page
     */
    Route::get("/", "HomeController@getIndex");

    /**
     * Pages that need not to be accessed when
     * User is logged in the app
     *
     * @see \SaleBoss\Filters\SimpleAccessFilter
     */
    Route::group(['before' => 'guest'],function(){
        Route::get('auth/login', "AuthController@getLogin");
        Route::post("auth/login","AuthController@postLogin");
        Route::get("auth/register","AuthController@getRegister");
        Route::post("auth/register","AuthController@postRegister");
    });

    /**
     * Pages that need to be accessed only
     * when user is logged in the app
     *
     * @see \SaleBoss\Filters\SimpleAccessFilter
     */
    Route::group(['before' => 'auth'],function(){
        Route::get('dash','UserController@getDash');
        Route::get('auth/logout','AuthController@getLogout');
	    Route::resource('menu','MenuController',['except' => ['show','index']]);
	    Route::resource('menu_type','MenuTypeController',['except' => 'show']);
	    Route::get('menu_type/{id}','MenuController@index');
	    Route::resource('groups','GroupController', ['except' => 'show']);
	    Route::resource('users','UserController');
	    Route::resource('permissions','PermissionController');
	    Route::resource('states','StateController');
    });
});

/**
 * Pages that are Opilo Specific
 *
 * @see SlaeBoss\Controllers\Opilo namespace
 */
Route::group(["namespace" => 'Controllers\Opilo'],function(){
    Route::group(['before' => 'auth'],function() {
        Route::resource('customers','CustomerController');
        Route::get('my/customers','CustomerController@myIndex');
	    Route::get('orders/create/{customer_id}','OrderController@create');
        Route::post('orders/sale/{customer_id}','OrderController@store');
        Route::get('my/orders','OrderController@myIndex');
        Route::get('orders/{id}','OrderController@show');
        Route::get('orders','OrderController@index');
	    Route::put('orders/accounter_approve/{id}','OrderController@accounterUpdate');
	    Route::put('orders/suspend/{id}','OrderController@suspendUpdate');
	    Route::put('orders/support_approve/{id}','OrderController@supporterUpdate');
    });
});
