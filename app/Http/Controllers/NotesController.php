<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidat;
use App\Models\Parcour;
use App\Models\Matiere;
use App\Models\Note;
use App\Repositories\ParcoursRepository;

class NotesController extends Controller
{
    public function __construct(){
      $this->middleware('admin')->only('transcription');
    }
    public function transcription($parcour){
      $p = Parcour::findOrFail($parcour);
      $ecole = $p->ecole;
      // Listes des matieres
      $matieres = array();
      // Matièers pour EGI et EGCN sont les mêmes
      // Si EGCN alors on prend la liste des matiere de l'EGI
      switch( $ecole->id ){
        case 1: // EGI
          $matiere_ecole_id = 1; break;
        case 2: // EGMCS
          $matiere_ecole_id = 2; break;
        case 3: //EGCN
          $matiere_ecole_id = 1; break;
      }
      $data = Matiere::where('ecole_id', $matiere_ecole_id)->get();

      foreach($data as $matiere){
        $matieres[] = (object) [
          'id' => $matiere->id,
          'name' => $matiere->nom,
          'coef' => $matiere->coefficient,
          'ecole_id' => $matiere->ecole_id,
        ];
      }
      // Liste des candidats
      $candidats = array();
      $candidats_liste = Candidat::current()->where('parcour_id', $p->id)->get();

      //$all_parcours = Parcour::where('ecole_id', $p->ecole_id)->get();
      $all_parcours = ParcoursRepository::getParcoursByCycle( 1 );
      if( count($candidats_liste) < 1 ){
        return view('notes.aucun')->with('parcours', $p)->with('parcours_list', $all_parcours);
      }
      /*
       * for each candidat, generate other candidat object with note
       * Expected result:
       * Candidat = {
        id: '', 'rang': '', name: '',
        notes: [{point: a, candidat_id: b, parcour_id: c, matiere_id: d}],
        moyenne: ''
       * }
      */
      $rang = 1;
      foreach ($candidats_liste as $candidat) {
        // Getting candidat note
        $notes = Note::where('candidat_id', $candidat->id)->get()->toArray();
        //dd($notes);
        //$mode = Note::UPDATE_MODE;
        // If the candidat has no notes in database, that means
        // the database query shoulD be INSERT so UPDATE query is false
        if( sizeof($notes) == 0 ){
          // Insert query
          //$mode = Note::INSERT_MODE;
          // create empty note for each matiere
          foreach($matieres as $matiere){
              $data = [
                  'point' => '0',
                  'candidat_id' => $candidat->id,
                  'parcour_id' => $candidat->parcour_id ,
                  'matiere_id' => $matiere->id
              ];
              $note = Note::create( $data );
              array_push($notes, $note);

          }
        }
        //dd($notes);
        // replacing '.' by ','
        /*foreach($notes as $note){
          $note['point'] = str_replace('.', ',', $note['point']);
        }*/
        $candidat_note = collect( $notes )->map( function($item){
          $item['point'] = str_replace('.', ',', $item['point']);
          return $item;
        } );

        $candidats[] = (object) [
            'id' => $candidat->id,
            'rang' => $rang,
            'name' => strtoupper($candidat->nom).' '. $candidat->prenom,
            'notes' => $candidat_note,
            'moyenne' => Note::moyenne($notes)
        ];
        $rang++;
      }
      return view('notes.transcription')->with('candidats', $candidats)->with('parcours', $p)->with('matieres', $matieres)->with('parcours_list', $all_parcours);
    }


    public function update(Request $request){
      if( $request->ajax() ){
        // note property: javascript object
        // auto converted to php associative array
        $postData = $request->note;
        $note = Note::find($postData['id']);
        $note->point = str_replace(',', '.', $postData['point']);
        $note->save();
        return response()->json('Enregistrement succès');
      }
    }
}
