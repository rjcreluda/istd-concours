<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConcourInfo extends Model
{
    use HasFactory;

    protected $fillable = array('concour_id', 'cycle', 'date_1', 'date_2');

    public function concour(){
      return $this->belongsTo(Concour::class);
    }
}
