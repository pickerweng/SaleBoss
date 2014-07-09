<?php

Route::group(["namespace" => "Controllers"], function(){
	Route::get("/", "HomeController@getIndex");
	Route::get("auth/login","AuthController@getLogin");
	Route::post("auth/login","AuthController@postLogin");
	Route::get("auth/register","AuthController@getRegister");
	Route::post("auth/register","AuthController@postRegister");
});

Route::group(["namespace" => 'Controllers\Opilo'],function(){
	Route::get('opilo-orders','OrderController@getIndex');
	Route::get('opilo-orders/create','OrderController@getCreate');
	Route::get('opilo-orders/{id}','OrderController@getShow');
	Route::post('opilo-orders','OrderController@postCreate');
	Route::get('opilo-orders/{:id}/edit','OrderController@getEdit');
	Route::get('opilo-orders/{:id}','OrderController@getShow');
	Route::put('opilo-orders/{:id}','OrderController@putUpdate');
});
