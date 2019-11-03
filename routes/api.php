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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post("/posts/create","ApiPostsControllers@store");
Route::put("/posts/edit","ApiPostsControllers@edit");
Route::delete("/posts/delete","ApiPostsControllers@destroy");
Route::post("/posts/comments/create","ApiCommentsControllers@store");
Route::delete("/posts/comments/delete","ApiCommentsControllers@destroy");
