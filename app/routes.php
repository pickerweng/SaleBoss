<?php

Route::group(["namespace" => "Controllers"], function(){
	Route::get("/", "HomeController@getIndex");
	Route::get("auth/login","AuthController@getLogin");
	Route::post("auth/login","AuthController@postLogin");
	Route::get("auth/register","AuthController@getRegister");
	Route::post("auth/register","AuthController@getRegister");
	Route::get('dash',"UserController@getDash");
});
