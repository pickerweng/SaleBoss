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
	    Route::get('users/summary','UserController@getSummary');
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

    Route::resource(
        'opilo-order',
        'OrderController'
    );
});
