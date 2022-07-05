<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;
    protected $fillable = ['reference', 'localisation', 'capacite'];

    public function candidats(){
      return $this->hasMany('App\Models\Candidat');
    }
}
