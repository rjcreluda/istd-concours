<?php

namespace App\Http\Controllers;

use App\Models\EntreeStock;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Fournisseur;
use App\Models\Article;
use App\Models\Livraison;

class EntreeStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entree = EntreeStock::orderByDesc('created_at')->get();
        //dd($entree);
        return view('stock.entree')->with('entree', $entree);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fournisseurs = Fournisseur::all();
        $articles = Article::all();
        return view('stock.create')->with('fournisseurs', $fournisseurs)
                            ->with('articles', $articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Note: javascript array of object are converted to php
        // array, js object => associative array
        if( $request->ajax() ){
            $articles = $request->articles;
            $f_id = $request->fournisseur_id;
            //return $articles[0];

            DB::transaction( function() use($f_id, $articles) {
                $livraison = new Livraison();
                $livraison->fournisseur_id = $f_id;
                $livraison->save();
                foreach( $articles as $article ){
                    $produit = Article::find($article['id']);
                    $entree = EntreeStock::create([
                        'titre' => 'Entrée '.$article['nom'],
                        'prixEntree' => $article['prix'] ,
                        'qte' => $article['qte'],
                        'livraison_id' => $livraison->id,
                        'article_id' => $article['id']
                    ]);
                    // Update article quantity
                    $produit->qte += $entree->qte;
                    $produit->save();
                }
            });

            return 'success';
            // Creation Livraison
            /*$livraison = new Livraison();
            $livraison->fournisseur_id = $request->fournisseur_id;
            $livraison->save();*/
            // Insertion entree stock
            /*foreach( $articles as $article ){
                DB::create();
                $entree = EntreeStock::create([
                    'titre' => 'Entrée '.$article->nom,
                    'prixEntree' => $prix[$i] ,
                    'qte' => 5,
                    'livraison_id' => $livraison->id,
                    'article_id' => $article->id
                ]);
            }*/
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntreeStock  $entreeStock
     * @return \Illuminate\Http\Response
     */
    public function show(EntreeStock $entreeStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EntreeStock  $entreeStock
     * @return \Illuminate\Http\Response
     */
    public function edit(EntreeStock $entreeStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EntreeStock  $entreeStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntreeStock $entreeStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EntreeStock  $entreeStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntreeStock $entreeStock)
    {
        //
    }
}
