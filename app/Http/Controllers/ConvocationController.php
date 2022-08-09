<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Candidat;
use App\Models\Parcour;

use App\Repositories\ParcoursRepository;
use Spipu\Html2Pdf\Html2Pdf;

class ConvocationController extends Controller
{
  public function __construct(){
    $this->parcoursRepo = new ParcoursRepository();
    //$this->candidatRep = new CandidatRepository();
    //
  }
  public function index(Candidat $candidat){
    //dd($candidat);
    return view('candidats.convocation')->with('candidat', $candidat);
  }

  // Liste des parcours avec nombre candidats
  public function liste_parcours(){


    $data = array();
    foreach( $this->parcoursRepo->getAll() as $p ){
      //$count = Candidat::
      $data[] = (object) array(
        'id' => $p->id,
        'nom' => $p->nom,
        'nbr_candidats' => count( $this->parcoursRepo->candidats( $p->id ) )
      );
    }
    return view('convocation.liste-parcours')
      ->with('parcours', $data)
      ->with('title', 'Impression convocation par parcours');
  }

  // Appercu PDF avant impression
  public function preview(Request $request, Parcour $parcour){
    $pdf = new Html2Pdf();
    $pdf->setDefaultFont('Arial');
    $data = array();
    $data['parcours'] = $parcour;
    $data['candidats'] = $this->parcoursRepo->candidats( $parcour->id );
    $test = $data['candidats'][0];
    set_time_limit(300);
    //dd( $test );
    setlocale(LC_TIME, 'fr-FR');
    $now = utf8_encode( strftime('%d %B %Y')) ;
    //dd($now);
    $content = view('convocation.print-preview', [
      'candidats' => $data['candidats'],
      'date_actuel' => $now ])->render();
    $pdf->writeHTML( $content );
    $str = $pdf->output('', 'S');
    $fichier = $parcour->code."-print-".date('dmy').".pdf";
    return response($str)->header('Content-Type', 'application/pdf')
                  ->header('Content-Length', strlen($str))
                  ->header('Content-Disposition', 'inline; filename="'.$fichier.'"');
    /*return view('convocation.print-preview')
      ->with('parcour', $parcour)
      ->with('title', 'Impression convocation par parcours');*/
  }
}
