<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcour;
use App\Models\Candidat;
use App\Models\Note;
use App\Models\Concour;

class ResultatsController extends Controller
{
    /* Resultat brute */
    public function brute(Parcour $parcour)
    {
      $data_available = true; // Check whether notes are available

        // Getting candidat list for each parcours
      if( $parcour->id ){
        $p = $parcour;
        //dd($parcour);
        $candidats_liste = Candidat::where('parcour_id', $p->id)->get();
        $rang = 1;
        $candidats = array();
        foreach ($candidats_liste as $candidat) {
          // Getting candidat note
          $notes = Note::where('candidat_id', $candidat->id)->get();
          // If the candidat has no notes in database, that means
          // no result for that parcour
          if( sizeof($notes) == 0 ){
            $data_available = false;
            break;
          }
          $candidats[] = (object) [
            'rang' => '',
            'numInscription' => $candidat->id,
            'nom' => strtoupper( $candidat->nom ).' '. $candidat->prenom,
            'centreExamen' =>$candidat->centre->lieu,
            'moyenne' => Note::moyenne($notes)
          ];
          $rang++;
        }
        if( $data_available ){
          // Sort by candidat's moyenne
          usort($candidats, function($a, $b){
            return ($b->moyenne < $a->moyenne) ? -1 : 1;
          });
          // Rang
          for($i = 0; $i < count($candidats); $i++){
            $rank = $i + 1;
            if( $rank == 1){
              $candidats[$i]->rang = '1er';
            }
            else{
              $candidats[$i]->rang = (string) $rank . 'e';
              if( $candidats[$i]->moyenne == $candidats[$i-1]->moyenne ){
                $candidats[$i]->rang = $candidats[$i-1]->rang;
                if( strpos($candidats[$i-1]->rang, 'x') == 0 )
                  $candidats[$i]->rang .= ' ex';
              }
            }
          }
          //dump($candidats);
          $page_title = 'Resultats du Concours d\'entrée en ' . $p->code;
        }

      }
      else{
        $parcour = null;
      }
      $parcours = Parcour::all();
      $data = array('parcours' => $parcours);
      $data['candidats'] = $candidats ?? null;
      $data['parcour'] = $parcour;
      return view('resultats.brute', [
        'parcours' => $parcours,
        'candidats' => $data['candidats'],
        'parcour' => $data['parcour']
      ]);
    }



  /* Résultats après deliberation */
  public function deliberation(Parcour $parcour){
      $data_available = true; // Check whether notes are available

        // Getting candidat list for each parcours
      if( $parcour->id ){
        $p = $parcour;
        //dd($parcour);
        $candidats_liste = Candidat::where('parcour_id', $p->id)->get();
        $rang = 1;
        $candidats = array();
        foreach ($candidats_liste as $candidat) {
          // Getting candidat note
          $notes = Note::where('candidat_id', $candidat->id)->get();
          // If the candidat has no notes in database, that means
          // no result for that parcour
          if( sizeof($notes) == 0 ){
            $data_available = false;
            break;
          }
          $eliminated = false;
          // Note eliminatoire et Moyenne deliberation
          $concour = Concour::active()->get()->first();
          $min_note = $concour->note_eliminatoire;
          $moyenne_deliberation = $concour->moyenne_deliberation;
          // Check if one of the note is eliminated
          foreach($notes as $note){
              if( (float) $note->point <= $min_note ){
                  $eliminated = true;
                  break;
              }
          }
          $moyenne = Note::moyenne($notes);
          // If the candidat is Eliminated, go to the next loop iteration
          if( $eliminated || $moyenne < $moyenne_deliberation )
          {
              continue;
          }
          $candidats[] = (object) [
            'rang' => '',
            'numInscription' => $candidat->id,
            'nom' => strtoupper( $candidat->nom ).' '. $candidat->prenom,
            'centreExamen' =>$candidat->centre->lieu,
            'moyenne' => Note::moyenne($notes)
          ];
          $rang++;
        }
        if( $data_available ){
          // Sort by candidat's moyenne
          usort($candidats, function($a, $b){
            return ($b->moyenne < $a->moyenne) ? -1 : 1;
          });
          // Rang
          for($i = 0; $i < count($candidats); $i++){
            $rank = $i + 1;
            if( $rank == 1){
              $candidats[$i]->rang = '1er';
            }
            else{
              $candidats[$i]->rang = (string) $rank . 'e';
              if( $candidats[$i]->moyenne == $candidats[$i-1]->moyenne ){
                $candidats[$i]->rang = $candidats[$i-1]->rang;
                if( strpos($candidats[$i-1]->rang, 'x') == 0 )
                  $candidats[$i]->rang .= ' ex';
              }
            }
          }
          //dump($candidats);
          $page_title = 'Resultats du Concours d\'entrée en ' . $p->code;
        }

      }
      else{
        $parcour = null;
      }
      $parcours = Parcour::all();
      $data = array('parcours' => $parcours);
      $data['candidats'] = $candidats ?? null;
      $data['parcour'] = $parcour;
      $format = new \NumberFormatter("fr-FR", \NumberFormatter::SPELLOUT);
      $data['count'] = isset( $candidats ) ? $format->format(count($candidats)) : 0;
      return view('resultats.deliberation', [
        'parcours' => $parcours,
        'candidats' => $data['candidats'],
        'parcour' => $data['parcour'],
        'count' => strtoupper($data['count'])
      ]);
    }
}
