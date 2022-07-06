<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use App\Models\Candidat;
use Illuminate\Http\Request;

class SallesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salles = Salle::all();
        return view('salles.index')->with('salles', $salles);
    }

    public function liste()
    {
        $salles = Salle::all();
        return view('salles.liste')->with('salles', $salles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'reference' => 'required|string',
            'localisation' => 'required|string',
            'capacite' => 'required',
        ]);
        Salle::create($request->only('reference', 'localisation', 'capacite'));
        return redirect()->back()->with('success', 'Opération succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salle  $salle
     * @return \Illuminate\Http\Response
     */
    public function show(Salle $salle)
    {
        $title = 'Liste des candidats en salle ' . $salle->reference;
        $candidats = Candidat::current()->where('salle_id', $salle->id)->get();
        return view('salles.show')
                    ->with('title', $title)
                    ->with('salle', $salle)
                    ->with('candidats', $candidats)
                    ->with('salles', Salle::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salle  $salle
     * @return \Illuminate\Http\Response
     */
    public function edit(Salle $salle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salle  $salle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salle $salle)
    {
        $request->validate([
            'reference' => 'required|string',
            'localisation' => 'required|string',
            'capacite' => 'required',
        ]);
        $salle->reference = $request->reference;
        $salle->localisation = $request->localisation;
        $salle->capacite = $request->capacite;
        $salle->save();
        return redirect()->back()->with('success', 'Opération succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salle  $salle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salle $salle)
    {
        $salle->delete();
        return redirect()->back()->with('info', 'Element supprimé');
    }
}
