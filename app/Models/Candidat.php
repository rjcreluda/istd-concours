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
      "civilite",
      "dateNaissance",
      "lieuNaissance",
      "adresse",
      "codePostale",
      "telephone",
      "candidatBacc",
      "serieBacc",
      "mentionBacc",
      "anneeBacc",
      "parcour_id",
      "centre_id",
      "salle_id",
      "concour_id",
      "num_arrive",
      "moyen_paiement",
      "num_mandat",
      "date_envoie",
      "date_arrive",
      "dossier_ok",
      "email",
      "observation",
      "jury_id",
      "user_id"
    );

    protected $appends = ['photo', 'nomComplet', 'codeParcour', 'cycle'];

    public function getPhotoAttribute(){
      return $this->imageProfile != '' ? $this->imageProfile : '/resources/img/default/default.png';
    }
    public function getCodeParcourAttribute(){
      return $this->parcour->code;
    }

    public function getCycleAttribute(){
      return $this->parcour->cycle;
    }

    public function getNomCompletAttribute(){
      return strtoupper($this->nom) . ' ' . ucwords( $this->prenom );
    }

    public function parcour(){
      return $this->belongsTo('App\Models\Parcour');
    }

    public function salle(){
      return $this->belongsTo('App\Models\Salle');
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
