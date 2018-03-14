<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ParametreModule;

class ParametreController extends Controller
{

    public function update(Request $request){
      $parametre = ParametreModule::first();
      $parametre->budget                      = $request->budget ;
//       $parametre->taux_tantieme               = $request->taux_tantieme ;
//       $parametre->totale_tantieme             = $request->totale_tantieme ;
//       $parametre->is_penalite_static          = $request->is_penalite_static ;
//       $parametre->penalite_static_frais       = $request->penalite_static_frais ;
//       $parametre->penalite_dynamic_taux       = $request->penalite_dynamic_taux ;
      $parametre->save();
      return response()->json($parametre);
  }
}
