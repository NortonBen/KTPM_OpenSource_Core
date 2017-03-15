<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'],function (){

    Route::post('/login',"AuthController@login");
    Route::post('/register',"AuthController@register");
    Route::post('/edit/{id}',"AuthController@edit");
    Route::post('/delete/{id}' ,"AuthController@destroy");


    Route::group([ "prefix" => "v1.0",'middleware' => 'token'],function (){
        Route::get("/user","UserController@index");
        Route::get("/user/{user}","UserController@show");
        Route::post("/user","UserController@store");
        Route::put("/user/{user}","UserController@update");
        Route::delete("/user/{user}","UserController@destroy");
    });
});

