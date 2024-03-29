<?php

namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProprietaireModel;
use App\Events\EventGlobale ;

class ProprietaireController extends Controller
{
    //Fetch
    public function fetch(Request $request){
        $proprietaire = ProprietaireModel::orderBy('id', 'desc')->get();
      	return response()->json($proprietaire);
    }

    //Single
    public function single(Request $request,$id){
        $proprietaire = ProprietaireModel::find($id) ;
        // get previous proprietaire id
        $previous = ProprietaireModel::where('id', '<', $proprietaire->id)->max('id');
        // get next proprietaire id
        $next = ProprietaireModel::where('id', '>', $proprietaire->id)->min('id');
        return response()->json(['proprietaire'=> $proprietaire,
                                 'previous'=> $previous,
                                 'next'=> $next]
                                );
    }

    //Insert
    public function insert(Request $request){
        $proprietaire = new ProprietaireModel();
        $proprietaire->nom       = $request->nom ;
        $proprietaire->prenom    = $request->prenom ;
        $proprietaire->save();
        event(new EventGlobale(response()->json(['proprietaire' => ['insert' => $proprietaire]])));
      	return response()->json($proprietaire);
    }

    //Update
    public function update(Request $request, $id){
        $proprietaire = ProprietaireModel::find($id);
        $proprietaire->nom       = $request->nom ;
        $proprietaire->prenom    = $request->prenom ;
        $proprietaire->save();
        event(new EventGlobale(response()->json(['proprietaire' => ['update' => $proprietaire]])));
      	return response()->json($proprietaire);
    }
    
    //Delete
    public function delete(Request $request, $id){
        $isDeleted = ProprietaireModel::destroy($id) ;
        event(new EventGlobale(response()->json(['proprietaire' => ['deleted_id' => $id]])));
      	return response()->json($isDeleted);
    }
    
     //Delete Multiple
     public function deleteMultiple(Request $request){
        $isDeleted = ProprietaireModel::destroy($request->ids) ;
        event(new EventGlobale(response()->json(['proprietaire' => ['deleted_ids' => $request->ids]])));
        return response()->json($isDeleted);
    }
      
}
