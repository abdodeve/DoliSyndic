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

//User Routes
Route::post('userLogin','userController@userLogin');
Route::post('userDetails','userController@userDetails')->middleware('auth:api');
Route::post('userLogout','userController@userLogout')->middleware('auth:api');

Route::group(['middleware' => ['auth:api']], function () {

    //Parametre Routes
    Route::post('parametreUpdate','ParametreController@update');
    Route::post('parametreFetch','ParametreController@fetch');

    //Proprietaire Routes
    Route::get('proprietaireFetch','proprietaireController@fetch'); 
    Route::get('proprietaireSingle/{rowid}','proprietaireController@single'); 
    Route::post('proprietaireInsert','proprietaireController@insert');
    Route::put('proprietaireUpdate/{rowid}','proprietaireController@update');
    Route::delete('proprietaireDelete/{rowid}','proprietaireController@delete');
    
});

