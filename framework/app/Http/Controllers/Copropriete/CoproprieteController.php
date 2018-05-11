<?php

namespace App\Http\Controllers\Copropriete;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CoproprieteModel;
use Illuminate\Support\Facades\DB;

class CoproprieteController extends Controller
{
    public function getCoproprietesExercices () {
        
        // Copropriétés
        $coproprietes = DB::table('copropriete')
        ->select('copropriete_primaire.id as id_copropriete_primaire', 'copropriete_primaire.nom')
        ->join('copropriete_primaire', 
                'copropriete.fk_copropriete_primaire',
                '=', 
                'copropriete_primaire.id')
        ->distinct()
        ->get();
        
        //Exercices
        $exercices = DB::table('copropriete')
        ->select('copropriete.exercice')
        ->join('copropriete_primaire', 
                'copropriete.fk_copropriete_primaire',
                '=',
                'copropriete_primaire.id')
        ->distinct()
        ->get();

         //Coproprietés / Exercices
         $coproprietes_exercices = DB::table('copropriete')
         ->select('copropriete_primaire.id as id_copropriete_primaire', 
                  'copropriete_primaire.nom',
                  'copropriete.exercice')
         ->join('copropriete_primaire',
                 'copropriete.fk_copropriete_primaire',
                 '=',
                 'copropriete_primaire.id')
         ->distinct()
         ->orderBy('copropriete.exercice')
         ->get();
        return response()->json(['coproprietes' => $coproprietes, 
                                 'exercices' => $exercices,
                                 'coproprietes_exercices' => $coproprietes_exercices
                                ]);
    }
}
