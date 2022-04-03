<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;
    protected $fillable = array(
      "numInscription",
      "nom",
      "prenom",
      "sexe",
      "dateNaissance",
      "centre_id",
      "parcour_id",
      "email",
      "telephone1",
      "telephone2",
      "concour_id"
    );

    protected $appends = ['photo'];

    public function getPhotoAttribute(){
      return $this->imageProfile != '' ? $this->imageProfile : '/resources/img/default/default.png';
    }

    public function parcour(){
      return $this->belongsTo('App\Models\Parcour');
    }

    public function centre(){
      return $this->belongsTo('App\Models\Centre');
    }

    public function notes(){
      return $this->hasMany('App\Models\Note');
    }

    public function scopeCurrent($query){
      $concours = Concour::active()->get()->first();
      return $query->where('concour_id', $concours->id );
    }
}
