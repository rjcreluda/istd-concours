<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spipu\Html2Pdf\Html2Pdf;

use App\Models\Candidat;
use App\Models\Parcour;
use App\Models\Centre;
use App\Models\Salle;

class ImpressionController extends Controller
{
    public function __construct(){
      $this->pdf = new Html2Pdf();
      $this->pdf->setDefaultFont('Arial');
    }

    public function print( Request $request ){
      set_time_limit(300);
      setlocale(LC_TIME, 'fr-FR');
      $now = utf8_encode( strftime('%d %B %Y')) ;
      // Autres centre que Diego
      if( $request->get('type') && $request->get('centre_id') ){
        $centre_id = $request->get('centre_id');
        $centre = Centre::find( $centre_id );
        $query = Candidat::query();
        $query = $query->current()->where( 'centre_id', $centre_id );
        $candidats = $query->when( $request->get('salle_id'), function($q) use($request){
          $q->where( 'salle_id', $request->get('salle_id') );
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
          'date_actuel' => $now,
          'concours' =>  activeConcours(),
          'concours_date' => array( $cycle_1[0]->date_1, $cycle_1[0]->date_2 ),
          'centre' => $centre
        ];
        if( $request->get('salle_id') ){
          $data['salle'] = Salle::find( $request->get('salle_id') );
        }
        $content = view('fiche-presence.print-preview', $data )->render();
        $this->pdf->writeHTML( $content );
        $str = $this->pdf->output('', 'S');
        $fichier = 'fiche-'.$centre->lieu."-print-".date('dmy').".pdf";
        return response($str)->header('Content-Type', 'application/pdf')
                    ->header('Content-Length', strlen($str))
                    ->header('Content-Disposition', 'inline; filename="'.$fichier.'"');
      }
    }
}
