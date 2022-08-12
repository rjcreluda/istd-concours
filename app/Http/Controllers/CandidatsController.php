<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Candidat;
use App\Models\Ecole;
use App\Models\Parcour;
use App\Models\Centre;
use App\Models\Concour;

class CandidatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('candidats.index');
    }


    public function attribution(){
        $concours = Concour::active()->get()->first();
        return view('candidats.attribution')->with( compact('concours') );
    }

    public function ecole(Ecole $ecole){
        $parcours = Parcour::where('ecole_id', $ecole->id)->get();
        return view('candidats.index')->with('parcours', $parcours)
                        ->with('ecole', $ecole);
    }
    // Show list of candidants in one parcour
    public function parcours(Ecole $ecole, Parcour $parcour){
        $title = 'Liste des candidats en ' . $parcour->code;
        $candidats = Candidat::current()->where('parcour_id', $parcour->id)->get();
        return view('candidats.parcours')
                    ->with('title', $title)
                    ->with('parcour', $parcour)
                    ->with('candidats', $candidats)
                    ->with('parcours', Parcour::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parcours = Parcour::all();
        $centres = Centre::all();
        return view('candidats.create')->with('parcours', $parcours)->with('centres', $centres);
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
            'nom' => 'required|string',
            'civilite' => 'required|string',
            'dateNaissance' => 'required',
            'adresse' => 'required',
            'lieuNaissance' => 'required',
            'centre_id' => 'required|integer',
            'parcour_id' => 'required|integer',
        ]);

        $data = $request->except(['_token']);
        $data['concour_id'] = Concour::active()->get()->first()->id;
        $data['user_id'] = auth()->user()->id;
        Candidat::create($data);

        return redirect()->back()->with('success', 'Candidat enregistré avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidat  $candidat
     * @return \Illuminate\Http\Response
     */
    public function show(Candidat $candidat)
    {

        if( $candidat->notes()->exists() ){
            $moyenne = \App\Models\Note::moyenne($candidat->notes);
        }
        else{
            $moyenne = null;
        }
        return view('candidats.show')->with('candidat', $candidat)->with('moyenne', $moyenne);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidat  $candidat
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidat $candidat)
    {
        $this->authorize('edit', $candidat);
        $parcours = Parcour::all();
        $centres = Centre::all();
        return view('candidats.edit')->with('parcours', $parcours)->with('centres', $centres)->with('candidat', $candidat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidat  $candidat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidat $candidat)
    {
        $request->validate([
            'nom' => 'required|string',
            'civilite' => 'required|string',
            'dateNaissance' => 'required',
            'adresse' => 'required',
            'lieuNaissance' => 'required',
            'centre_id' => 'required|integer',
            'parcour_id' => 'required|integer',
        ]);
        $data = $request->except(['_token', '_method']);
        $data['user_id'] = auth()->user()->id;
        //dd($data);
        Candidat::where('id', $candidat->id)->update( $data );

        return redirect()->back()->with('success', 'Information mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidat  $candidat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidat $candidat)
    {
        $candidat->delete();
        return redirect()->back()->with('success', 'Suppression effectué');
    }
}
