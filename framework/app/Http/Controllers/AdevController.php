<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB ;
use App\Syndic_proprietaire;
use App\User ;

class AdevController extends Controller
{
    //adev page
  public function adev_p1 (){
    
   
     $data = User::all();
     return view('adev_page',compact('data'));
//     $data = DB::table('syndic_proprietaire')->get() ;
//     return view('adev_page',compact('data'));
  }
  
}
