<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Centre;
use App\Models\Salle;
use App\Models\Candidat;

class FichePresenceController extends Controller
{
  // Liste les centre d'examens
  public function index(){
    return view('fiche-presence.index')->with('centres', Centre::all());
  }
  // Liste des candiants dans un centre
  public function centre(Centre $centre, Salle $salle){
    $centres = Centre::all();
    $candidats = Candidat::current()->where('centre_id', 1)->get();
    return view('fiche-presence.fiche')->with('centre', $centre)
                  ->with('centres', $centres )
                  ->with('candidats', $candidats );
  }
  // Liste des candidats par salle
  public function salle(Centre $centre, Salle $salle){
    dd($salle->id);
    return view('fiche-presence.centre')->with('centre', $centre)
                  ->with('centres', Centre::all())
                  ->with('salle', $salle);
  }
}
