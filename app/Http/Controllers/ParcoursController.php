<?php

namespace App\Http\Controllers;

use App\Models\Parcour;
use Illuminate\Http\Request;

class ParcoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parcours = Parcour::all();
        return view('parcours.index', ['parcours' => $parcours]);
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
        $parcour = Parcour::create( $request->all() );
        if( $parcour ){
            return response()->json( $parcour );
        }
        else{
            return response()->json('erreur');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parcour  $parcour
     * @return \Illuminate\Http\Response
     */
    public function show(Parcour $parcour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parcour  $parcour
     * @return \Illuminate\Http\Response
     */
    public function edit(Parcour $parcour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parcour  $parcour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $parcour = Parcour::find( $request->id );
        $parcour->update( $request->except('id') );
        return response()->json( $parcour );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parcour  $parcour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $p = Parcour::find($request->id);
        $result = $p->delete();
        return response()->json('supprimé');
    }
}
