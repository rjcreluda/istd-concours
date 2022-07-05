<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidat;
use App\Models\Parcour;
use App\Models\Concour;
use App\Models\Salle;

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
      $concour_active = Concour::active()->get()->first();
      $parcours = Parcour::has('Candidats')->get();
      $salles = Salle::all();
      foreach( $salles as $salle ){
        $salle_remplit = false;
        foreach( $parcours as $parcour ){
          // Getting candidats lists within that parcours in the current concours
          $candidats = Candidat::current()
                          ->where('pacour_id', $parcour->id)
                          ->where('salle_id', null) // qui n'appartient pas encore dans une salle
                          ->take(3) // on prend 3 candidats
                          ->get();
          if( count($candidats) > 0 ){
            foreach( $candidats as $candidat){
              if( $salle->place_dispo >= 1 ){
                $candidat->salle_id = $salle->id; // on place le candidat dans la salle
                $salle->place_dispo--; // on decremente le nombre de place disponible dans la salle
              }
              if( $salle->place_dispo == 0 ){
                $salle_remplit = true;
                break;
              }
            }
          }
          if( $salle_remplit ){
            $salle_remplit = false;
            break;
          } // on passe à la salle suivant si la salle actuel est déjà remplit
        }
      }
      return 123;
    }
}
