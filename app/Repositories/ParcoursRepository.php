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

  public function candidats( $parcour_id ){
    $p = $this->findById( $parcour_id );
    $candidats = $p->candidats->filter( function($c){
      return $c->concour_id == activeConcours()->id;
    });
    return $candidats;
  }

  public function findById( $id ){
    return Parcour::findOrFail($id);
  }
}