<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcour extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'code', 'ecole_id', 'cycle', 'niveau' ];

    public function candidats(){
      return $this->hasMany('App\Models\Candidat');
    }

    public function ecole(){
      return $this->belongsTo('App\Models\Ecole');
    }
}
