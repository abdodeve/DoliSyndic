<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request ;

Route::get('/', function () {
    return view('welcome');
});

Route::get('hello','AdevController@adev_p1');

Route::get('testSession',function(){

    // Store a piece of data in the session...
    ///session(['key_adev_web' => 'abdo habchi WEB']);
  
    $session_adev = session('key_adev_web');
    return response()->json($session_adev);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
