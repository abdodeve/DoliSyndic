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
Route::post('copyHashUsers','userController@copyHashUsers');
Route::post('userLogin','userController@userLogin');
Route::post('userDetails','userController@userDetails')->middleware('auth:api');
Route::post('userLogout','userController@userLogout')->middleware('auth:api');
Route::post('forgot/password','userController@forgotPassword');


//Email Routes
Route::get('mail/send', 'Mail\UserMailController@send');


Route::group(['middleware' => ['auth:api']], function () {

    //User Routes
    Route::post('changePassword','userController@changePassword'); 

    //Parametre Routes
    Route::post('parametreUpdate','ParametreController@update');
    Route::post('parametreFetch','ParametreController@fetch');


    //Proprietaire Routes
    Route::get('proprietaire/fetch', 'Proprietaire\ProprietaireController@fetch');
    Route::get('proprietaire/single/{rowid}', 'Proprietaire\ProprietaireController@single');
    Route::post('proprietaire/insert','Proprietaire\ProprietaireController@insert');
    Route::put('proprietaire/update/{rowid}', 'Proprietaire\ProprietaireController@update');
    Route::delete('proprietaire/delete/{rowid}', 'Proprietaire\ProprietaireController@delete');
    Route::post('proprietaire/deleteMultiple', 'Proprietaire\ProprietaireController@deleteMultiple');
}) ;
