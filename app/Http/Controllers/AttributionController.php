<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidat;
use App\Models\Parcour;
use App\Models\Concour;

class AttributionController extends Controller
{
    public function attribuer_numero_cadidat(){
      $concour_active = Concour::active()->get()->first();
      $parcours = Parcour::has('Candidats')->get();
      $annee = date('y');
      $min = 1;
      $slice = 150;
      $start = 1;
      $end = $start + $slice;
      $resp = array();
      foreach( $parcours as $p ){
        $candidats = $p->candidats->where('concour_id', $concour_active->id);
        $ecole = $p->ecole;
        $i = $start;
        foreach( $candidats as $candidat ){
          $num = str_pad($i, 4, "0", STR_PAD_LEFT);
          $code_centre = $candidat->centre->code;
          $numInscription = $annee . '/' . $ecole->code . '/' . $code_centre . $num;
          $resp[] = $numInscription;
          $candidat->numInscription = $numInscription;
          $candidat->save();
          $i++;
        }
        $start = $end +1;
        $end = $start + $slice;
      }
      $concour_active->num_auto = 1;
      $concour_active->save();
      return $resp;
    }

    public function attribuer_salle_candidat(){
      return 123;
    }
}
