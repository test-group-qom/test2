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
//------ Post ------
Route::middleware('user')->post('post','PostController@store');
Route::middleware('admin')->put('post/{id}','PostController@update');
Route::middleware('admin')->delete('post/{id}','PostController@destroy');
Route::get('post/{id}','PostController@show');
Route::get('post','PostController@index');

//------ Category ------
Route::middleware('admin')->post('cat','CategoryController@store');
Route::middleware('admin')->put('cat/{id}','CategoryController@update');
Route::middleware('admin')->delete('cat/{id}','CategoryController@destroy');
Route::get('cat/{id}','CategoryController@show');
Route::get('cat','CategoryController@index');


//-----------
Route::get('postbycat/{id}','CategoryPostController@showpostsbycat');
Route::get('catbypost/{id}','CategoryPostController@showcatsbypost');



//------ Comment ------
Route::middleware('admin')->delete('comment/{id}','CommentController@destroy');
Route::post('comment','CommentController@store');
Route::get('comment','CommentController@index');
Route::get('comment/{id}','CommentController@show');
Route::get('post/{id}/comment','CommentController@showCommentsbyPost');

//------ File ------
Route::middleware('user')->post('file','FileController@index');
Route::middleware('user')->get('file/all','FileController@all');
Route::middleware('admin')->delete('file/{id}','FileController@destroy');

//------ User Login ------
Route::middleware('admin')->get('alluser','RegisterController@alluser');
Route::post('register','RegisterController@register');
Route::get('logout','RegisterController@logout');
Route::middleware('admin')->post('register/admin','RegisterController@adminreg');
Route::middleware('user')->post('/login','RegisterController@login');