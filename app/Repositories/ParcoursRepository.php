<?php
namespace App\Repositories;

use App\Models\Parcour;

class ParcoursRepository extends BaseRepository{
  protected $parcours;

  public function __construct( $id = null ){
    $this->parcours = $id == null ? new Parcour : Parcour::find($id);
  }

  public function getAll(){
    return $this->parcours
            ->select(['parcours.*'])->get();
  }

  /**
   * Get lists of candidats for active concours
   * @param $parcour_id id of the parcours
   * @return $candidats - list of candidats belongs to that parcours
   * */
  public function candidats( $parcour_id, $creation_date = null ){
    $p = $this->findById( $parcour_id );
    $candidats = $p->candidats->filter( function($candidat){
      return $candidat->concour_id == activeConcours()->id;
    });
    //dd( $candidats[0]->created_at );
    //dd( $creation_date );
    if( $creation_date != null ){
      $candidats = $candidats->filter( function($candidat) use($creation_date){
        $date_saisie_candidat = explode( ' ', $candidat->created_at )[0];
        //dd( [$date_saisie, $creation_date] );
        return $date_saisie_candidat == $creation_date;
      });
    }
    return $candidats;
  }

  public function findById( $id ){
    return Parcour::findOrFail($id);
  }

  /**
   * Get lists of parcours in 2nd cycle
   * @param null
   * @return Parcour $parcours - list of parcours
   * */
  public function getSecondCycle(){
    return Parcour::where('cycle', 2)->get();
  }

  public function getByEcole( $ecole_id ){
    $parcours = Parcour::where('ecole_id', $ecole_id)->get();
    $parcours = $parcours->map( function($parcour){
      $parcour->candidats_count = count( $this->candidats( $parcour->id ) );
      return $parcour;
    });
    return $parcours;
  }
}