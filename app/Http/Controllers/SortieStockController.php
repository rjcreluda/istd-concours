<?php

namespace App\Http\Controllers;

use App\Models\SortieStock;
use Illuminate\Http\Request;

class SortieStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sorties = SortieStock::all();
        return view('stock.sortie')->with('sorties', $sorties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stock.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SortieStock  $sortieStock
     * @return \Illuminate\Http\Response
     */
    public function show(SortieStock $sortieStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SortieStock  $sortieStock
     * @return \Illuminate\Http\Response
     */
    public function edit(SortieStock $sortieStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SortieStock  $sortieStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SortieStock $sortieStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SortieStock  $sortieStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(SortieStock $sortieStock)
    {
        //
    }
}
