<?php

namespace App\Http\Controllers;

use App\Models\Stockage;
use Illuminate\Http\Request;

class StockageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock = Stockage::all();
        return response($stock, 200);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stockage  $stockage
     * @return \Illuminate\Http\Response
     */
    public function show(Stockage $stockage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stockage  $stockage
     * @return \Illuminate\Http\Response
     */
    public function edit(Stockage $stockage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stockage  $stockage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stockage $stockage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stockage  $stockage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stockage $stockage)
    {
        //
    }
}
