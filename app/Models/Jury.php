<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jury extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'concour_id'];

    public function candidats(){
      return $this->hasMany('App\Models\Candidat');
    }
}
