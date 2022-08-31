<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Centre;
use App\Models\Salle;
use App\Models\Jury;
use App\Models\Candidat;
use App\Models\Parcour;
use App\Repositories\ParcoursRepository;

class AfficheListeCandidatsController extends Controller
{
  // Liste les centre d'examens
  public function index(){
    return view('liste-candidat-par-salle.index')->with('centres', Centre::all());
  }

  // Liste les centre d'examens pour un cycle
  public function centre_examen( Request $request ){

    /*if( $cycle != '1er-cycle' && $cycle != '2nd-cycle')
      return redirect()->back();*/

    return view('liste-candidat-par-salle.centre_examen')
              ->with('centres', Centre::all());
  }

  // Liste des candiants dans un centre d'examen (ville)
  // A imprimer
  public function voir(Request $request, Centre $centre, Parcour $parcours){

    /*if( $request->get('cycle') == null ||
      ( $request->get('cycle') != '1er-cycle' && $request->get('cycle') != '2nd-cycle' ) )
      return redirect()->back();*/

    /*$c = $request->get('cycle');
    $cycle = (int) $c[0];*/

    $centres = Centre::all();

    if( $parcours->id == null ){
      $candidats = Candidat::current()->where('centre_id', $centre->id)->get();
      $parcoursRepository = new ParcoursRepository();
      $all_parcours = [];
      foreach( $parcoursRepository->getAll() as $p ){
        $nbr_candidat = 0;
        $all_parcours[] = (object) [
          'id' => $p->id,
          'nom' => $p->nom,
          'code' => $p->code,
          'candidat_count' => $candidats->filter( function($c) use($p){
            return $p->id == $c->parcour_id;
          } )->count()
        ];
      }
      //dd( $all_parcours );
      return view('liste-candidat-par-salle.liste-parcours')
                    ->with('centre', $centre)
                    ->with('centres', $centres )
                    ->with('parcour', $parcours )
                    ->with('parcours', $all_parcours );
    }
    else{ // Parcour not null
      $candidats = Candidat::current()->where('centre_id', $centre->id)->where('parcour_id', $parcours->id)->get();
      return view('liste-candidat-par-salle.voir')
                    ->with('centre', $centre)
                    ->with('centres', $centres )
                    ->with('parcour', $parcours)
                    ->with('parcours', Parcour::all() )
                    ->with('candidats', $candidats );
    }

  }


  public function voir_jury(Request $request, Centre $centre, Jury $jury){

    /*if( $request->get('cycle') == null ||
      ( $request->get('cycle') != '1er-cycle' && $request->get('cycle') != '2nd-cycle' ) )
      return redirect()->back();*/

    /*$c = $request->get('cycle');
    $cycle = (int) $c[0];*/

    $centres = Centre::all();

    if( $jury->id == null ){
      $candidats = Candidat::current()->where('centre_id', $centre->id)->get();
      $candidats = $candidats->filter( function( $candidat ) use($cycle){
        return $candidat->cycle == $cycle;
      } );
      //dd($candidats);
      if($centre->lieu != 'Antsiranana' )
        return view('liste-candidat-par-salle.voir')->with('centre', $centre)
                    ->with('centres', $centres )
                    ->with('candidats', $candidats )
                    ->with('cycle', $c);
      if( $cycle == 1 ){
        return view('liste-candidat-par-salle.liste-salle')
                    ->with('centre', $centre)
                    ->with('centres', $centres )
                    ->with('salle', $salle )
                    ->with('salles', Salle::all() )
                    ->with('candidats', $candidats )
                    ->with('cycle', $c);
      }
      else if( $cycle == 2 ){
        return view('liste-candidat-par-salle.liste-jury')
                    ->with('centre', $centre)
                    ->with('centres', $centres )
                    ->with('jury', Jury::all() )
                    ->with('candidats', $candidats )
                    ->with('cycle', $c);
      }

    }
    else{
      $candidats = Candidat::current()
                    ->where('centre_id', $centre->id)
                    ->where('jury_id', $jury->id)->get();
      return view('liste-candidat-par-salle.voir')
                    ->with('centre', $centre)
                    ->with('centres', $centres )
                    ->with('jury', $jury)
                    ->with('salles', Salle::all() )
                    ->with('candidats', $candidats )
                    ->with('cycle', '2nd-cycle');
    }

  }

  // Liste des candidats par salle
  public function salle(Centre $centre, Salle $salle){
    dd($salle->id);
    return view('liste-candidat-par-salle.centre')->with('centre', $centre)
                  ->with('centres', Centre::all())
                  ->with('salle', $salle);
  }
}
