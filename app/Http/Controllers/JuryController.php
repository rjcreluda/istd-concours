<?php

namespace App\Http\Controllers;

use App\Models\Jury;
use Illuminate\Http\Request;

class JuryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $juries = Jury::all();
        return view('jury.index')->with('juries', $juries);
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
            'nom' => 'required',
        ]);
        $concour = activeConcours();
        Jury::create([
            'concour_id' => $concour->id,
            'nom' => $request->input('nom')
        ]);
        return redirect()->back()->with('success', 'Jury enregistré');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jury  $jury
     * @return \Illuminate\Http\Response
     */
    public function show(Jury $jury)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jury  $jury
     * @return \Illuminate\Http\Response
     */
    public function edit(Jury $jury)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jury  $jury
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jury $jury)
    {
        $request->validate([
            'nom' => 'required',
        ]);
        //$concour = activeConcours();
        $jury->nom = $request->nom;
        $jury->save();
        return redirect()->back()->with('success', 'Jury mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jury  $jury
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jury $jury)
    {
        $jury->delete();
        return redirect()->back()->with('info', 'Element supprimé');
    }
}
