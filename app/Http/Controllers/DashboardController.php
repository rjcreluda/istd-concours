<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StatRepository;
use App\Models\Centre;
use App\Models\Ecole;
use App\Models\Parcour;

class DashBoardController extends Controller
{
  public function index(){
    $stat = new StatRepository();

    $centre_exam = Centre::all();
    $stat_centre = array();
    foreach( $centre_exam as $centre ){
      $stat_centre[] = (object) array(
        'centre' => $centre->lieu,
        'candidats' => $stat->countCandidatByCentre( $centre->id )
      );
    }

    $ecoles = Ecole::all();
    $stat_ecole = array();
    foreach($ecoles as $ecole){
      array_push( $stat_ecole, (object) [
        'ecole' => $ecole->code,
        'candidats' => $stat->countCandidatByEcole( $ecole->id )
      ]);
    }

    $parcours = Parcour::all();
    $stat_parcours = array();
    foreach($parcours as $p){
      array_push( $stat_parcours, (object) [
        'code' => $p->code,
        'candidats' => $stat->countCandidatByParcour( $p->id )
      ]);
    }

    $all_stat = (object) [
      'centres' => $stat_centre,
      'ecoles' => $stat_ecole
    ];

    //dd($all_stat);

    return view('dashboard')
              ->with('stat', $all_stat)
              ->with('stat_ecole', $stat_ecole)
              ->with('stat_ecole', $stat_ecole);
  }
}
