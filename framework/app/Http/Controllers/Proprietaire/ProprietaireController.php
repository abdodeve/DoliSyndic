<?php

namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\proprietaireModel;

class ProprietaireController extends Controller
{
    //Fetch
    public function fetch(Request $request){
        $proprietaire = proprietaireModel::orderBy('rowid', 'desc')->get();
      	return response()->json($proprietaire);
    }

    //Single
    public function single(Request $request,$rowid){
        $proprietaire = proprietaireModel::find($rowid) ;
        // get previous proprietaire id
        $previous = proprietaireModel::where('rowid', '<', $proprietaire->rowid)->max('rowid');
        // get next proprietaire id
        $next = proprietaireModel::where('rowid', '>', $proprietaire->rowid)->min('rowid');
        return response()->json(['proprietaire'=> $proprietaire,
                                 'previous'=> $previous,
                                 'next'=> $next]
                                );
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
        $proprietaire = proprietaireModel::find($rowid);
        $proprietaire->nom       = $request->nom ;
        $proprietaire->prenom    = $request->prenom ;
        $proprietaire->save();
      	return response()->json($proprietaire);
    }
    
    //Delete
    public function delete(Request $request, $rowid){
        $isDeleted = proprietaireModel::destroy($rowid) ;
      	return response()->json($isDeleted);
    }
    
     //Delete Multiple
     public function deleteMultiple(Request $request){
        $isDeleted = proprietaireModel::destroy($request->rowids) ;
        return response()->json($isDeleted);
    }
      
}
