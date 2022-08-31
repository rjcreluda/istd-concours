<?php
namespace App\Repositories;

use App\Models\Parcour;
use App\Models\Ecole;

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

  public function getCandidats( $parcour_id ){
    $this->parcours::find($parcour_id)->candidats()
                      ->where('concour_id', activeConcours()->id )
                      ->get();
  }

  public function findById( $id ){
    return Parcour::findOrFail($id);
  }

  /**
   * Get lists of parcours in 2nd cycle: 3ème anné & Ingénieur
   * @param null
   * @return Parcour $parcours - list of parcours
   * */
  public function getSecondCycle(){
    return Parcour::where('cycle', 2)->get();
  }

  /**
   * Get lists of parcours in  cycle
   * @param Integer $cycle - (1: premier cycle, 2: seconde cycle)
   * @return Parcour $parcours - list of parcours
   * */
  public static function getParcoursByCycle( $cycle, $ecole_code=null ){
    $cycle = (int) $cycle;
    if( $cycle == 0 || ($cycle != 1 && $cycle != 2) )
      return [];
    $ecole = $ecole_code != null ? Ecole::where('code', $ecole_code)->get()->first() : null;
    $parcours = Parcour::where('cycle', $cycle)
                        ->when( $ecole_code, function( $query ) use( $ecole ) {
                          return $query->where('ecole_id', $ecole->id);
                        } )
                        ->get();
    return $parcours;
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