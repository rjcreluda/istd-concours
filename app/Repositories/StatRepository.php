<?php
namespace App\Repositories;

use App\Models\Parcour;
use App\Models\Ecole;
use App\Models\Candidat;

public class StatRepository extends BaseRepository{

  public function __construct(){}

  public function countCandidatByEcole(){
    //$ecoles = Ecole::all();
  }

  /**
  * @param $centre_id
  * @return int - nombre des candidats
  * */
  public function countCandidatByCentre( $centre_id ){
    $centre_id = (int) $centre_id;
    if( $centre_id == 0 ) return 0;
    $candidat_count = Candidat::current()->where('centre_id', $centre_id )->count();
    return $candidat_count;
  }

  public function countCandidatByParcour( $parcour_id ){
    $parcour_id = (int) $parcour_id;
    if( $parcour_id == 0 ) return 0;
    $candidat_count = Candidat::current()->where('parcour_id', $parcour_id)->count();
    return $candidat_count;
  }
}