<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Candidat;
use App\Models\Parcour;

use App\Repositories\ParcoursRepository;
use Spipu\Html2Pdf\Html2Pdf;

use Illuminate\Support\Carbon;

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

  // Liste de tout candidats
  public function liste_candidats(){
    //Carbon::setLocale('fr');
    $data = array();
    $candidats = DB::table('candidats')
                      ->join('parcours', 'parcours.id', '=', 'candidats.parcour_id')
                      ->join('centres', 'candidats.centre_id', '=', 'centres.id')
                      ->select('candidats.id', 'candidats.nom', 'candidats.prenom', 'candidats.numInscription', 'candidats.created_at as date_saisie', 'candidats.concour_id', 'parcours.code as parcour', 'centres.lieu as centre')
                      ->where('candidats.concour_id', '=', activeConcours()->id)
                      ->get();
    setlocale(LC_TIME, 'fr-FR');
    $candidats = $candidats->map( function($c){
      $c->date_saisie = utf8_encode( strftime('%d %B %Y %H:%M', strtotime($c->date_saisie)) );
      return $c;
    });
    //dd($candidats);
    return view('convocation.liste-candidats')
      ->with('candidats', $candidats)
      ->with('title', 'Impression convocation un à un');
  }

  public function impression_par_date( Request $request ){
    $date = $request->get('date') ? dateToMySQL( $request->get('date') ) : null;
    $data = array();
    foreach( $this->parcoursRepo->getAll() as $p ){
      $data[] = (object) array(
        'id' => $p->id,
        'nom' => $p->nom,
        'nbr_candidats' => count( $this->parcoursRepo->candidats( $p->id, $date ) )
      );
    }
    return view('convocation.par-date')
      ->with('parcours', $data)
      ->with('date', $request->get('date'))
      ->with('title', 'Impression convocation par date');
  }

  public function impression_par_jour( Request $request ){
    $date = date('Y-m-d');
    $data = array();
    foreach( $this->parcoursRepo->getAll() as $p ){
      $data[] = (object) array(
        'id' => $p->id,
        'nom' => $p->nom,
        'nbr_candidats' => count( $this->parcoursRepo->candidats( $p->id, $date ) )
      );
    }
    return view('convocation.par_jour')
      ->with('parcours', $data)
      ->with('title', 'Impression par jour');
  }

  // Appercu PDF avant impression, dts
  public function preview(Request $request, Parcour $parcour){
    $pdf = new Html2Pdf();
    $pdf->setDefaultFont('Arial');
    $data = array();
    $data['parcours'] = $parcour;
    $ecole = $parcour->ecole;
    $data['candidats'] = $this->parcoursRepo->candidats( $parcour->id );
    //$test = $data['candidats'][0];
    $date_concours = $data['candidats'][0]->dateConcours;
    set_time_limit(300);
    setlocale(LC_TIME, 'fr-FR');
    $now = utf8_encode( strftime('%d %B %Y')) ;
    //dd($now);
    switch( $parcour->niveau ){
      case 1:
        $content = view('convocation.print-preview', [
        'candidats' => $data['candidats'],
        'parcours' => $parcour,
        'ecole' => $ecole,
        'date_actuel' => $now,
        'date_concours' => $date_concours ])->render();
        break;
      case 2:
        $content = view('convocation.print-dtss', [
        'candidats' => $data['candidats'],
        'parcours' => $parcour,
        'ecole' => $ecole,
        'date_actuel' => $now,
        'date_concours' => $date_concours ])->render();
        break;
      case 3:
        $content = view('convocation.print-ing', [
        'candidats' => $data['candidats'],
        'parcours' => $parcour,
        'ecole' => $ecole,
        'date_actuel' => $now,
        'date_concours' => $date_concours ])->render();
        break;
    }

    $pdf->writeHTML( $content );
    $str = $pdf->output('', 'S');
    $fichier = "convocation-" . $parcour->code . "-print-" . date('dmy') . ".pdf";
    return response($str)->header('Content-Type', 'application/pdf')
                  ->header('Content-Length', strlen($str))
                  ->header('Content-Disposition', 'inline; filename="'.$fichier.'"');
  }

  // Appercu PDF avant impression, candidat individuel
  public function preview_candidat(Request $request, Candidat $candidat){
    $pdf = new Html2Pdf();
    $pdf->setDefaultFont('Arial');
    $data = array();
    $parcour = $candidat->parcour;
    $data['parcours'] = $parcour;
    $ecole = $parcour->ecole;
    $data['candidats'] = [$candidat];
    $date_concours = $candidat->dateConcours;
    set_time_limit(300);
    setlocale(LC_TIME, 'fr-FR');
    $now = utf8_encode( strftime('%d %B %Y')) ;
    //dd($now);
    switch( $parcour->niveau ){
      case 1:
        $content = view('convocation.print-preview', [
        'candidats' => $data['candidats'],
        'parcours' => $parcour,
        'ecole' => $ecole,
        'date_actuel' => $now,
        'date_concours' => $date_concours ])->render();
        break;
      case 2:
        $content = view('convocation.print-dtss', [
        'candidats' => $data['candidats'],
        'parcours' => $parcour,
        'ecole' => $ecole,
        'date_actuel' => $now,
        'date_concours' => $date_concours ])->render();
        break;
      case 3:
        $content = view('convocation.print-ing', [
        'candidats' => $data['candidats'],
        'parcours' => $parcour,
        'ecole' => $ecole,
        'date_actuel' => $now,
        'date_concours' => $date_concours ])->render();
        break;
    }

    $pdf->writeHTML( $content );
    $str = $pdf->output('', 'S');
    $fichier = "convocation-" . str_replace(' ',  '-', strtolower($candidat->nom)) . "-print-" . date('dmy') . ".pdf";
    return response($str)->header('Content-Type', 'application/pdf')
                  ->header('Content-Length', strlen($str))
                  ->header('Content-Disposition', 'inline; filename="'.$fichier.'"');
  }
}
