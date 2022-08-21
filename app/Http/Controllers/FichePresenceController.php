<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Centre;
use App\Models\Salle;
use App\Models\Jury;
use App\Models\Candidat;

class FichePresenceController extends Controller
{
  // Liste les centre d'examens
  public function index(){
    return view('fiche-presence.index')->with('centres', Centre::all());
  }

  // Liste les centre d'examens pour un cycle
  public function centre_examen( Request $request, $cycle){

    if( $cycle != '1er-cycle' && $cycle != '2nd-cycle')
      return redirect()->back();

    return view('fiche-presence.centre_examen')
              ->with('centres', Centre::all())
              ->with('cycle', $cycle);
  }

  // Liste des candiants dans un centre d'examen (ville)
  // A imprimer
  public function voir(Request $request, Centre $centre, Salle $salle){

    if( $request->get('cycle') == null ||
      ( $request->get('cycle') != '1er-cycle' && $request->get('cycle') != '2nd-cycle' ) )
      return redirect()->back();

    $c = $request->get('cycle');
    $cycle = (int) $c[0];

    $centres = Centre::all();

    if( $salle->id == null ){
      $candidats = Candidat::current()->where('centre_id', $centre->id)->get();
      $candidats = $candidats->filter( function( $candidat ) use($cycle){
        return $candidat->cycle == $cycle;
      } );
      //dd($candidats);
      if($centre->lieu != 'Antsiranana' )
        return view('fiche-presence.voir')->with('centre', $centre)
                    ->with('centres', $centres )
                    ->with('candidats', $candidats )
                    ->with('cycle', $c);
      if( $cycle == 1 ){
        return view('fiche-presence.liste-salle')
                    ->with('centre', $centre)
                    ->with('centres', $centres )
                    ->with('salle', $salle )
                    ->with('salles', Salle::all() )
                    ->with('candidats', $candidats )
                    ->with('cycle', $c);
      }
      else if( $cycle == 2 ){
        return view('fiche-presence.liste-jury')
                    ->with('centre', $centre)
                    ->with('centres', $centres )
                    ->with('jury', Jury::all() )
                    ->with('candidats', $candidats )
                    ->with('cycle', $c);
      }

    }
    else{
      $candidats = Candidat::current()->where('centre_id', $centre->id)->where('salle_id', $salle->id)->get();
      return view('fiche-presence.voir')
                    ->with('centre', $centre)
                    ->with('centres', $centres )
                    ->with('salle', $salle)
                    ->with('salles', Salle::all() )
                    ->with('candidats', $candidats )
                    ->with('cycle', $c);
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
        return view('fiche-presence.voir')->with('centre', $centre)
                    ->with('centres', $centres )
                    ->with('candidats', $candidats )
                    ->with('cycle', $c);
      if( $cycle == 1 ){
        return view('fiche-presence.liste-salle')
                    ->with('centre', $centre)
                    ->with('centres', $centres )
                    ->with('salle', $salle )
                    ->with('salles', Salle::all() )
                    ->with('candidats', $candidats )
                    ->with('cycle', $c);
      }
      else if( $cycle == 2 ){
        return view('fiche-presence.liste-jury')
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
      return view('fiche-presence.voir')
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
    return view('fiche-presence.centre')->with('centre', $centre)
                  ->with('centres', Centre::all())
                  ->with('salle', $salle);
  }
}
