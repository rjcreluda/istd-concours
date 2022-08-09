<?php
namespace App\Repositories;

use App\Models\Concour;

class ConcourRepository extends BaseRepository{

  protected $concours;

  public function __construct(){
    $this->concours = new Concour;
  }

  public function getAll(){
    return $this->concours
            ->select(['concours.*'])->get();
  }
  // Get currently activate concour
  public function activeConcours(){
    return $this->concours->where('active', 1)->get()->first()
  }
}