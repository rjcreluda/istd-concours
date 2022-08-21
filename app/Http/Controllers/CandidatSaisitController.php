<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcour;
use App\Models\Candidat;
use App\Repositories\ParcoursRepository;

class CandidatSaisitController extends Controller
{

    public function __construct(){
      $this->parcoursRepository = new ParcoursRepository();
    }
    public function saisit_du_jour(){
      $date = date('Y-m-d');
      $parcours = array();
      foreach( $this->parcoursRepository->getAll() as $p ){
        $parcours[] = (object) array(
          'id' => $p->id,
          'nom' => $p->nom,
          'nbr_candidats' => count( $this->parcoursRepository->candidats( $p->id, $date ) )
        );
      }
      $title = 'Saisit du jour';
      return view('saisit-candidat.jour', compact('parcours', 'title'));
    }
}
