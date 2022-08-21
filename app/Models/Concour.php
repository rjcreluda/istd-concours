<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concour extends Model
{
    use HasFactory;

    protected $fillable = [
      'anneeUniv',
      'note_eliminatoire',
      'moyenne_deliberation',
      'nombre_candidat',
      'active',
      'num_auto',
      'salle_auto',
      'jury_auto',
      'decret'
    ];
    protected $appends = ['status', 'num_generated', 'jury_generated'];

    public function scopeActive($query){
      return $query->where('active', 1);
    }

    public function getStatusAttribute(){
      return $this->active ? 'active' : 'inactive';
    }

    public function getNumGeneratedAttribute(){
      return $this->num_auto ? 'attribué' : 'non attribué';
    }

    public function getJuryGeneratedAttribute(){
      return $this->jury_auto ? 'attribué' : 'non attribué';
    }

    public function getSalleGeneratedAttribute(){
      return $this->salle_auto ? 'attribué' : 'non attribué';
    }

    public function infos(){
      return $this->hasMany(ConcourInfo::class);
    }
  }
