<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spipu\Html2Pdf\Html2Pdf;

use App\Models\Candidat;
use App\Models\Parcour;
use App\Models\Centre;
use App\Models\Salle;
use App\Models\Jury;

class ImpressionController extends Controller
{
    public function __construct(){
      $this->pdf = new Html2Pdf();
      $this->pdf->setDefaultFont('Arial');
      $this->now = utf8_encode( strftime('%d %B %Y')) ;
    }

    public function print( Request $request ){
      set_time_limit(300);
      setlocale(LC_TIME, 'fr-FR');

      // Autres centre que Diego
      if( $request->get('type') && $request->get('centre_id') ){
        $type = $request->get('type');
        if( $type == 'fiche-presence' ){
          $data = $this->data_fiche_presence( $request );
          $content = view('fiche-presence.print-preview', $data['content'] )->render();
        }
        else if( $type == 'liste-candidat' ){
          $data = $this->data_liste_candidats( $request );
          $content = view('liste-candidat-par-salle.print-preview', $data['content'] )->render();
        }


        $this->pdf->writeHTML( $content );
        $str = $this->pdf->output('', 'S');
        $fichier = $data['filename'];
        return response($str)->header('Content-Type', 'application/pdf')
                    ->header('Content-Length', strlen($str))
                    ->header('Content-Disposition', 'inline; filename="'.$fichier.'"');
      }
    }

    private function data_liste_candidats( $request ){
      $centre_id = $request->get('centre_id');
      $parcour_id = $request->get('parcour_id');
      $parcour = Parcour::find( $parcour_id );
      $centre = Centre::find( $centre_id );
      $query = Candidat::query();
      $candidats = $query->current()
                      ->where( 'centre_id', $centre_id )
                      ->where( 'parcour_id', $parcour->id )->get();
      $concours = activeConcours();
        $concours_info = $concours->infos;
        $cycle_1 = $concours_info->filter( function($concours){
          return $concours->cycle == '1er cycle';
        });
        $cycle_2 = $concours_info->filter( function($concours){
          return $concours->cycle == '2nd cycle';
        });
      $data = [
          'candidats' => $candidats,
          'date_actuel' => $this->now,
          'concours' =>  activeConcours(),
          'concours_date' => array( $cycle_1[0]->date_1, $cycle_1[0]->date_2 ),
          'centre' => $centre,
          'niveau' => niveau_etude( $parcour->niveau )
        ];
      $fichier = 'liste-candidats-'.$parcour->code."-print-".date('dmy').".pdf";
        return array(
          'content' => $data,
          'filename' => $fichier
        );
    }

    private function data_fiche_presence( $request ){
      $centre_id = $request->get('centre_id');
        $centre = Centre::find( $centre_id );
        $query = Candidat::query();
        $query = $query->current()->where( 'centre_id', $centre_id );
        $candidats = $query->when( $request->get('salle_id'), function($q) use($request){
          $q->where( 'salle_id', $request->get('salle_id') )->orderBy('nom');
        } )->get();
        $candidats = $query->when( $request->get('jury_id'), function($q) use($request){
          $q->where( 'jury_id', $request->get('jury_id') )->orderBy('nom');
        } )->get();
        //$candidats = Candidat::current()->where('centre_id', $centre_id)->get();
        $concours = activeConcours();
        $concours_info = $concours->infos;
        $cycle_1 = $concours_info->filter( function($concours){
          return $concours->cycle == '1er cycle';
        });
        $cycle_2 = $concours_info->filter( function($concours){
          return $concours->cycle == '2nd cycle';
        });
        $data = [
          'candidats' => $candidats,
          'date_actuel' => $this->now,
          'concours' =>  activeConcours(),
          'concours_date' => array( $cycle_1[0]->date_1, $cycle_1[0]->date_2 ),
          'centre' => $centre,
          'niveau' => $request->get('niveau')
        ];
        if( $request->get('salle_id') ){
          $data['salle'] = Salle::find( $request->get('salle_id') );
        }
        if( $request->get('jury_id') ){
          $data['jury'] = Jury::find( $request->get('jury_id') );
        }
        $fichier = 'fiche-'.$centre->lieu."-print-".date('dmy').".pdf";
        return array(
          'content' => $data,
          'filename' => $fichier
        );
    }
}
