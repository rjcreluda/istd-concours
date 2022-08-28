<?php
namespace App\Repositories;

use App\Models\Candidat;
use App\Models\Ecole;

class CandidatRepository extends BaseRepository{
  protected $candidats;

  public function __construct( $id = null ){
    $this->candidats = $id == null ? new Candidat : Candidat::find($id);
  }

  public function getAll(){
    return $this->candidats
            ->select(['candidats.*'])->get();
  }

  /**
   * Get lists of candidats for active concours
   * @param $parcour_id id of the candidats
   * @return $candidats - list of candidats belongs to that candidats
   * */
  public function parcours( $parcour_id, $creation_date = null ){
    return $this->candidats->where('concour_id', activeConcours()->id)
              ->where('parcour_id', $parcour_id)->get();
  }

  public function findById( $id ){
    return Candidat::findOrFail($id);
  }

  /**
   * Get lists of candidats in 2nd cycle
   * @param null
   * @return Candidat $candidats - list of candidats
   * */
  public function getSecondCycle(){
    return Candidat::where('cycle', 2)->get();
  }

  public function getByEcole( $ecole_id ){
    $id = (int) $ecole_id;
    $ecole = Ecole::find($id);
    $all_candidats = $ecole->candidats()->where('concour_id', activeConcours()->id)->get();
    return $all_candidats;
  }

}