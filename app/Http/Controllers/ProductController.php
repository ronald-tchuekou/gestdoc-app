<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Utils\ControllersHelper;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produit = Produit::all();
        $result =  Array(
            'status' => 'OK',
            'records' => $produit
        );
        return response($result, 200);
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
        // Validation.
        $response = ControllersHelper::validated($request, Produit::$rules);
        if($response->getStatusCode() == 202)
            return $response;
        // Save.
        $produit = new Produit;
        $produit->designation = $request->designation;
        $produit->stockInitial = $request->stockInitial;
        $produit->prixUnitaire = $request->prixUnitaire;
        $produit->conditionnement = $request->conditionnement;
        $produit->categorie = $request->categorie;
        $produit->stockCritique = $request->stockCritique;
        $result = ControllersHelper::callBackSave($produit->save(), $produit);
        return response($result, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        $result = Array(
            'status'=>'OK',
            'records' => $produit,
        );
        return response($result, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $produit)
    {
        $result = Array(
            'status' => 'OK',
            'records' => $produit->delete()
        );
        return response($result, 200);
    }
}
