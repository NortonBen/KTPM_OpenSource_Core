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
Route::group(['namespace' => 'Apiv3', "prefix" => "data"],function (){
    Route::get('/sexs',"DataController@sexs");
    Route::get('/typeactions',"DataController@typeactions");
    Route::get('/relationships',"DataController@relationships");
});

Route::group(['namespace' => 'Api'],function (){
    
    Route::get('/check',"HomeController@check");

    Route::get('/test',"HomeController@test");

    //Route::group(['middleware' => 'checkpost'], function (){
        Route::post('/login',"AuthController@login");
        Route::post('/register',"AuthController@register");
    //});


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


    Route::post('/login',"AuthController@login");
    Route::post('/register',"AuthController@register");
    
    Route::group(['middleware' => 'token.v2'],function (){
        Route::get("/user","UserController@index");
        Route::get("/user/{user}","UserController@show");
        Route::post("/user","UserController@store");
        Route::post("/user/password/{user}","UserController@password");
        Route::put("/user/{user}","UserController@update");
        Route::delete("/user/{user}","UserController@destroy");
    });
});

Route::group(['namespace' => 'Apiv3', "prefix" => "v3.0"],function (){

    Route::post('/login',"AuthController@login");
    Route::post('/register',"AuthController@register");

    Route::group(['middleware' => 'token.v2'],function (){
        Route::get("/user","UserController@index");
        Route::get("/user/{user}","UserController@show");
        Route::post("/user","UserController@store");
        Route::post("/user/password/{user}","UserController@password");
        Route::put("/user/{user}","UserController@update");
        Route::delete("/user/{user}","UserController@destroy");

        Route::get("/caption","CaptionController@index");
        Route::get("/caption/{caption}","CaptionController@show");
        Route::post("/caption","CaptionController@store");
        Route::put("/caption/{caption}","CaptionController@update");
        Route::delete("/caption/{caption}","CaptionController@destroy");

        Route::get("/action/{caption}","ActionController@index");
        Route::post("/action/{caption}","ActionController@store");
        Route::delete("/action/{caption}","ActionController@destroy");

        Route::get("/comment/{caption}","CommentController@index");
        Route::post("/comment","CommentController@store");
        Route::put("/comment/{comment}","CommentController@update");
        Route::delete("/comment/{comment}","CommentController@destroy");

    });
});
