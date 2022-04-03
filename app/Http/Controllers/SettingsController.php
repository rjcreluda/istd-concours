<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Concour;

class SettingsController extends Controller
{
  public function index(){
    $setting = Setting::first();
    $concours = Concour::active()->get()->first();
    //dd($concours);
    return view('settings.index', [
      'concours' => $concours,
      'setting' => $setting
    ]);
  }

  public function appinfo(Request $request){
    $request->validate([
      'app_name' => 'required|string',
      'app_description' => 'required|string'
    ]);
  }

  public function concours(Request $request){
    $request->validate([
      'nombre_candidat' => 'required|integer',
      'note_eliminatoire' => 'required|numeric',
      'moyenne_deliberation' => 'required|numeric',
    ]);
    //dd($request->all());
    $concour = Concour::find($request->concours_id);
    $concour->nombre_candidat = $request->nombre_candidat;
    $concour->note_eliminatoire = $request->note_eliminatoire;
    $concour->moyenne_deliberation = $request->moyenne_deliberation;
    $concour->save();
    return redirect()->back()->with('success', 'Information à jour');
  }
}
