<?php

namespace App\Http\Controllers;

use App\Models\Concour;
use App\Models\ConcourInfo;
use Illuminate\Http\Request;

class ConcoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $concours = Concour::all();
        return view('concours.index')->with('concours', $concours);
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

    private function dateToMySQL($date){
        $tabDate = explode('/' , $date);
        $date  = $tabDate[2].'-'.$tabDate[1].'-'.$tabDate[0];
        return $date;
    }
    private function mySqlToDate($date){
        $tabDate = explode('-' , $date);
        $date  = $tabDate[2].'/'.$tabDate[1].'/'.$tabDate[0];
        return $date;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd( $request->all() );
        $request->validate([
            'anneeUniv' => 'required|numeric',
            'date1' => 'required',
            'date2' => 'required'
        ]);
        // On desactive le concours precedement active
        Concour::where('active', 1)->update(['active' => 0]);
        // On enregistre le concours
        $concours = Concour::create([
            'anneeUniv' => $request->anneeUniv,
            'note_eliminatoire' => 5,
            'moyenne_deliberation' => 10,
            'nombre_candidat' => 30,
            'active' => 1
        ]);
        // Enregistrement date de concours
        $cycles = array('1er cycle', '2nd cycle');
        $date_cycle1 = $request->date1;
        $date_cycle2 = $request->date2;
        $date1 = date_create( $date_cycle1[0] );
        $date2 = date_create( $date_cycle1[1] );
        ConcourInfo::create([
            'concour_id' => $concours->id,
            'cycle' => '1er cycle',
            'date_1' => $this->dateToMySQL( $date_cycle1[0]),
            'date_2' => $this->dateToMySQL( $date_cycle1[1])
        ]);
        $date3 = date_create( $date_cycle2[0] );
        $date4 = date_create( $date_cycle2[1] );
        ConcourInfo::create([
            'concour_id' => $concours->id,
            'cycle' => '2nd cycle',
            'date_1' => $this->dateToMySQL( $date_cycle2[0]),
            'date_2' => $this->dateToMySQL( $date_cycle2[1])
        ]);

        return redirect()->back()->with('success', 'Concours enregistré');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Concour  $concour
     * @return \Illuminate\Http\Response
     */
    public function show(Concour $concour)
    {
        $request->validate([
            'anneeUniv' => 'required|numeric'
        ]);
        $concour->anneeUniv = $request->anneeUniv;
        $concour->save();



        return redirec()->back()->with('success', 'Données à jour');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Concour  $concour
     * @return \Illuminate\Http\Response
     */
    public function edit(Concour $concour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Concour  $concour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Concour $concour)
    {
        $request->validate([
            'anneeUniv' => 'required|numeric',
            'active' => 'required|numeric'
        ]);
        $concour->active = $request->active;
        $concour->anneeUniv = $request->anneeUniv;
        $concour->save();

        $date_cycle1 = $request->date1;
        $date_cycle2 = $request->date2;

        $infos = $concour->infos;
        $infos[0]->date_1 = $this->dateToMySQL( $date_cycle1[0]);
        $infos[0]->date_2 = $this->dateToMySQL( $date_cycle1[1]);
        $infos[0]->save();

        $infos[1]->date_1 = $this->dateToMySQL( $date_cycle2[0] );
        $infos[1]->date_2 = $this->dateToMySQL( $date_cycle2[1] );
        $infos[1]->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Concour  $concour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Concour $concour)
    {
        $concour->delete();
        return redirect()->back();
    }
}
