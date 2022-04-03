<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boutique;

class BoutiqueController extends Controller
{
  public function index(){
    $enVente = Boutique::all();
    return view('boutique.index')->with('enVentes', $enVente);
  }
}
