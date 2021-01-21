<?php

namespace App\Http\Controllers;

use App\Models\DetailSortie;
use App\Models\SortieStock;
use App\Models\Stockage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SortieStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sortieStocks = SortieStock::all();
        return view('pages.outStock.index', compact('sortieStocks'));
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
        $redirection = redirect('sortie-stock');
        $sortieStock = new SortieStock;
        $this->setData($sortieStock, $request);

        // Validation.
        $validation = Validator::make($request->all(), SortieStock::$rules);
        if($validation->fails()){
            return $redirection
                ->withErrors($validation)
                ->withInput($request->input());
        }
        // Save.
        $stockState = $this->UpdateOrSave($request);
        if($stockState[0]){
            $lastId = DB::table('sortie_stocks')->insertGetId($sortieStock->toArray());
            $state = $this->saveDetail($lastId, $request);
            if($state){
                return $redirection
                    ->with('success', 'Opération éffectuée avec succès.')
                    ->withInput($request->input());
            }else{
                $errors = Array(
                    'error' => ['Error has proivded']
                );
                return $redirection
                    ->withErrors($errors)
                    ->withInput($request->input());
            }
        } else {
            $errors = Array(
                'error' => [$stockState[1]]
            );
            return $redirection
                ->withErrors($errors)
                ->withInput($request->input());
        }
    }

     /**
     * Function to update stock.
     */
    private function updateOrSave(Request $request)
    {
        $refPeremMag = ((string)$request->referenceP) . $request->datePeremptionS . $request->magSortie;
        $stock = Stockage::find($refPeremMag);
        if($stock !== null) {
            $newQte = $stock->qteStock - $request->qtSortie;
            if($newQte < 0)
                return [false, 'La quantité en stock dans le magasin *' . $request->magSortie . '* est insufisante.'];
            $save = $stock->update(['qteStock' => $newQte]);
            return [$save, ''];
        } else {
            return [false, 'Ce produit n\'à jamais été en stock dans le magasin ' . $request->magSortie];
        }
    }


    /**
     * Fonction qui permet de sauvegarder un nouveau details d'entré.
     */
    private function saveDetail(int $id, Request $request): bool
    {
        $detailSortie = new DetailSortie;
        $detailSortie->idSortie = $id;
        $detailSortie->idProduit = $request->idProduit;
        $detailSortie->qteSortie = $request->qtSortie;
        $detailSortie->referenceP = $request->referenceP;
        $detailSortie->motifSortie = $request->motifSortie;
        $detailSortie->obserSortie = $request->obserSortie;
        $detailSortie->datePeremptionS = $request->datePeremptionS;
        $detailSortie->magSortie = $request->magSortie;
        $detailSortie->magDest = $request->magDest;
        $detailSortie->save();
        return true;
    }

    /**
     * Function to set data to object.
     */
    private function setData(SortieStock $sortieStock, Request $request) 
    {
        $sortieStock->dateSortie = $request->dateSortie;
        $sortieStock->magasinDestination = $request->magDest;
        $sortieStock->magasinOrigine = $request->magSortie;
        $sortieStock->motifSortie = $request->motifSortie;
        $sortieStock->fourSortie = '';
        $sortieStock->ajouterParS = '';
        $sortieStock->modifierParS = '';
        $sortieStock->dateModifS = now();
        $sortieStock->supprimerPare = '';
        $sortieStock->dateSuppres = now();
        $sortieStock->selecteurs = $request->selecteur;
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
