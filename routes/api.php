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
    
    Route::get('/check',"HomeController@check");

    Route::group(['middleware' => 'checkpost'], function (){
        Route::post('/login',"AuthController@login");
        Route::post('/register',"AuthController@register");
    });


    Route::group([ "prefix" => "v1.0",'middleware' => 'token'],function (){
        Route::get("/user","UserController@index");
        Route::get("/user/{user}","UserController@show");
        Route::post("/user","UserController@store");
        Route::post("/user/password/{user}","UserController@password");
        Route::put("/user/{user}","UserController@update");
        Route::delete("/user/{user}","UserController@destroy");
    });

});


Route::group(['namespace' => 'ApiV2', "prefix" => "v2.0"],function (){

    Route::get('/check',"HomeController@check");

    Route::group(['middleware' => 'checkpost.v2'], function (){
        Route::post('/login',"AuthController@login");
        Route::post('/register',"AuthController@register");
    });

    Route::group(['middleware' => 'token.v2'],function (){
        Route::get("/user","UserController@index");
        Route::get("/user/{user}","UserController@show");
        Route::post("/user","UserController@store");
        Route::post("/user/password/{user}","UserController@password");
        Route::put("/user/{user}","UserController@update");
        Route::delete("/user/{user}","UserController@destroy");
    });
});
