<?php

use Illuminate\Http\Request;
use App\Events\EventGlobale ;
use Pusher\Laravel\Facades\Pusher;


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

Route::get('fireEvent', function () {
    $message = "test msg from backend" ;
    $event = new EventGlobale($message) ;
    $p = Pusher::trigger('adevChannel', 'EventGlobale', ['message' => $message]);
    return event($event);
    // return response()->json($p) ;
});
Route::get('sendEventMsg', function () {
//    $event = new EventGlobale('Salam akhi') ;
    $message = "Send Msg" ;
    $event = new EventGlobale($message) ;
    event($event);
    return array('success'=>'finished');
});


//User Routes
// Route::post('copyHashUsers','UserController@copyHashUsers');
// Route::post('userLogin','UserController@userLogin');
Route::post('user/logout','UserController@userLogout');
Route::post('forgot/password','UserController@forgotPassword');

Route::group(['middleware' => ['auth:api']], function () {

    //User Routes
    Route::get('user/loggedIn','UserController@userLoggedIn');
    Route::post('changePassword','UserController@changePassword'); 

    //Parametre Routes
    Route::post('parametreUpdate','ParametreController@update');
    Route::post('parametreFetch','ParametreController@fetch');

    //Proprietaire Routes
    Route::get('proprietaire/fetch', 'Proprietaire\ProprietaireController@fetch');
    Route::get('proprietaire/single/{id}', 'Proprietaire\ProprietaireController@single');
    Route::post('proprietaire/insert','Proprietaire\ProprietaireController@insert');
    Route::put('proprietaire/update/{id}', 'Proprietaire\ProprietaireController@update');
    Route::delete('proprietaire/delete/{id}', 'Proprietaire\ProprietaireController@delete');
    Route::post('proprietaire/deleteMultiple', 'Proprietaire\ProprietaireController@deleteMultiple');

    //Copropriete Routes
    Route::get('copropriete/coproprietesExercices','Copropriete\CoproprieteController@getCoproprietesExercices');
}) ;
