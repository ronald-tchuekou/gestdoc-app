<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // Validation
        $validate = Validator::make($request->all(), Fournisseur::$rules);
        if($validate->fails()){
            return $redirection
                ->withInput($request->input())
                ->withErrors($validate);
        }
        
        if(Fournisseur::checkIfExist($request)){ // Check if this personne exist or not.
            $errors = Array(
                'msg' => ['Une fournisseur possède déjà ces informations.']
            );
            return $redirection
            ->withInput($request->input())
            ->withErrors($errors);
        }

        $fournisseur = new Fournisseur;
        $this->setData($fournisseur, $request);
        if($fournisseur->save()){
            return $redirection
                ->withInput($request->all())
                ->with('success', 'Nouveau fournisseur ajouter avec succès.');
        }else{
            $errors = Array(
                'msg' => ['Une erreur est survenue.']
            );
            return $redirection
                ->withInput($request->all())
                ->withErrors($errors);
        }

    }

    private function setData (Fournisseur $f, Request $request){
        $f->nomFournisseur = $request->nomFournisseur;
        $f->adresse = $request->adresse;
        $f->telephoneFour = $request->telephoneFour;
        $f->emailFour = $request->emailFour;
        $f->nomContrF = $request->nomContrF;
        $f->regComF = $request->regComF;
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
