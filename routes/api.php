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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login',"Api\AuthController@login");
Route::group([ "prefix" => "v1.0"],function (){
    Route::get("/user","Api\UserController@index");
    Route::get("/user/{user}","Api\UserController@show");
    Route::post("/user","Api\UserController@store");
    Route::put("/user/{user}","Api\UserController@update");
    Route::delete("/user/{user}","Api\UserController@destroy");
});