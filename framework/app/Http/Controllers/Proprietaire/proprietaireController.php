<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\proprietaireModel;

class proprietaireController extends Controller
{
    //Fetch data
    public function fetch(Request $request){
        $proprietaire = proprietaireModel::all();
      	return response()->json($proprietaire);
    }
    //Insert
    public function insert(Request $request){
        $proprietaire = new proprietaireModel();
        $proprietaire->nom = 'jamalDebouz' ;
        $proprietaire->save();
      	return response()->json($proprietaire);
  	}
}