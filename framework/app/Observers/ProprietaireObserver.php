<?php

namespace App\Observers;

use App\Events\EventGlobale ;
use App\Models\ProprietaireModel;

class ProprietaireObserver
{
   public function creating(ProprietaireModel $proprietaireModel)
   {
      // $proprietaireModel->nom = strtoupper($proprietaireModel->nom);
      // $res = response()->json([$proprietaireModel]);
      // event(new EventGlobale($res));
   }
}