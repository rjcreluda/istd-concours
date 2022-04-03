<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = [
        'point',
        'candidat_id',
        'parcour_id',
        'matiere_id'
    ];

    public function candidat(){
      return $this->belongsTo('App\Models\Candidat');
    }

    public function matiere(){
      return $this->belongsTo('App\Models\Matiere');
    }

    public static function moyenne($notes){
      $total_note = 0;
      $total_coef = 0;
      // Edit: get parcour code
      $parcour_id = Candidat::find($notes[0]['candidat_id'])->parcour_id;
      $parcour_code = Parcour::find($parcour_id)->code;
      $except = array('GFC', 'TBA');

      foreach($notes as $note){
        $str = (string) $note['point'];
        $point = (float) str_replace(',', '.', $str);
        $matiere = Matiere::find($note['matiere_id']);
        //dump($matiere);
        // Edit: Coefficient pour Tertiairre

        if( $matiere->nom == 'Mathematique' && $matiere->ecole_id == 2 && in_array($parcour_code, $except) ){
          $matiere->coefficient = 2;
        }
        if( $matiere->nom == '  Français' && $matiere->ecole_id == 2 && in_array($parcour_code, $except) ){
          $matiere->coefficient = 1;
        }

        // end edit
        $coef = $matiere->coefficient;
        $total_note += $coef * (float) $point;
        $total_coef += $coef;
      }
      return round($total_note / $total_coef, 2);
    }
}
