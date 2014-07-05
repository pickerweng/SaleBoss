<?php

Route::group(["namespace" => "Controllers"], function(){
	Route::get("/", "HomeController@getIndex");
});
