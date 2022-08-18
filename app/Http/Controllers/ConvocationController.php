<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidat;

class ConvocationController extends Controller
{
    //
  public function index(Candidat $candidat){
    //dd($candidat);
    return view('candidats.convocation')->with('candidat', $candidat);
  }
}
