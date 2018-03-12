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

Route::post('userLogin','userController@userLogin');
Route::post('userDetails','userController@userDetails')->middleware('auth:api');
Route::post('userLogout','userController@userLogout')->middleware('auth:api');

Route::get('hello', function () {

	$data = array('nom'=>'abdo','age'=>25) ;

    return json_encode($data) ;
})->middleware('auth:api');

Route::post('login', function () {
	$data = array('page'=>'login page') ;
    return json_encode($data) ;
})->name('login');