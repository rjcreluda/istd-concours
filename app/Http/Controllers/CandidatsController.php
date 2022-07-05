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

    public function parcours(Ecole $ecole, Parcour $parcour){
        $title = 'Liste des candidats en ' . $parcour->code;
        return view('candidats.parcours')
                    ->with('title', $title)
                    ->with('parcour', $parcour)
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
        Candidat::create($data);

        /*$c = new Candidat;
        $c->nom = $request->nom;
        $c->prenom = $request->prenom;
        $c->civilite = $request->civilite;
        $c->dateNaissance = $request->dateNaissance;
        $c->lieuNaissance = $request->lieuNaissance;
        $c->telephone = $request->telephone;
        $c->code_postale = $request->code_postale;
        $c->centre_id = $request->centre_id;
        $c->parcour_id = $request->parcour_id;
        $c->concour_id = Concour::active()->get()->first()->id;
        $c->email = $request->email;
        //$c->imageProfile = '';
        if( $request->file('imageProfile') ){
            // There is an image to upload
            $fullname = $request->file('imageProfile')->getClientOriginalName();
            $filename = pathinfo($fullname, PATHINFO_FILENAME);
            $file_extension = '.'.$request->file('imageProfile')->getClientOriginalExtension();
            $new_name = $filename .'_'. time(). $file_extension;
            $upload_dir = 'uploads/' . date('Y') . '/';
            $request->file('imageProfile')->move($upload_dir, $new_name);
            $c->imageProfile = $upload_dir . $new_name;
        }

        $c->save();*/
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
            'sexe' => 'required|string',
            'dateNaissance' => 'required',
            'centre_id' => 'required|integer',
            'parcour_id' => 'required|integer',
        ]);
        //dd($request->all());
        $c = $candidat;
        $c->nom = $request->nom;
        $c->prenom = $request->prenom;
        $c->sexe = $request->sexe;
        $c->dateNaissance = $request->dateNaissance;
        $c->centre_id = $request->centre_id;
        $c->parcour_id = $request->parcour_id;
        $c->concour_id = 1; // a changer
        $c->email = $request->email;
        $c->imageProfile = '';
        $c->telephone1 = $request->telephone1;
        $c->telephone2 = $request->telephone2;
        $c->save();
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
