<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view('pages.fournisseur.index', compact('fournisseurs'));
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
        $redirection = redirect('fournisseurs');
        // Validation.
        $validation = Validator::make($request->all(), Fournisseur::$rules);
        if($validation->fails()){
            return $redirection
                ->withErrors($validation)
                ->withInput($request->input());
        }
        // Save the data.
        $state = $this->saveFournisseur($request);
            if($state){
                return $redirection
                    ->with('success', 'Data is added successful')
                    ->withInput($request->input());
            }else{
                $errors = Array(
                    'msg' => ['Error has proivded.']
                );
                return $redirection
                    ->withErrors($errors)
                    ->withInput($request->input());
            }
    }
    /**
     * Function to save the fournisseur.
     */
    private function saveFournisseur (Request $request): bool 
    {
        $fournisseur = new Fournisseur;
        $fournisseur->nomFournisseur = $request->nomFournisseur;
        $fournisseur->adresse = $request->adresse;
        $fournisseur->telephoneFour = $request->telephoneFour;
        $fournisseur->emailFour = $request->emailFour;
        $fournisseur->nomContrF = $request->nomContrF;
        $fournisseur->regComF = $request->regComF;
        return $fournisseur->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fournisseur $fournisseur)
    {
        //
    }
}
