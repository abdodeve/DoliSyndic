<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\proprietaireModel;

class proprietaireController extends Controller
{
    //Fetch
    public function fetch(Request $request){
        $proprietaire = proprietaireModel::all();
      	return response()->json($proprietaire);
    }

    //Single
    public function single(Request $request,$rowid){
        $proprietaire = proprietaireModel::find($rowid) ;
        return response()->json($proprietaire);
      }

    //Insert
    public function insert(Request $request){
        $proprietaire = new proprietaireModel();
        $proprietaire->nom       = $request->nom ;
        $proprietaire->prenom    = $request->prenom ;
        $proprietaire->save();
      	return response()->json($proprietaire);
    }

    //Update
    public function update(Request $request, $rowid){
        $proprietaire = proprietaireModel::find($rowid) ;
        $proprietaire->nom       = $request->nom ;
        $proprietaire->prenom    = $request->prenom ;
        $proprietaire->save();
      	return response()->json($proprietaire);
    }
    
    //Delete
    public function delete(Request $request, $rowid){
        $proprietaire = proprietaireModel::find($rowid) ;
        $res = $proprietaire->delete();
      	return response()->json($res);
  	}
      
}
