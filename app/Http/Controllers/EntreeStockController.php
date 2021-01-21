<?php

namespace App\Http\Controllers;

use App\Models\DetailleEntree;
use App\Models\EntreeStock;
use App\Models\Stockage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EntreeStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entreeStocks = EntreeStock::all();
        return view('pages.enterStock.index', compact('entreeStocks'));
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
        $redirection = redirect('entree-stock');
        $entreeStock = new EntreeStock;
        $this->setData($entreeStock, $request);

        // Validation.
        $validation = Validator::make($request->all(), EntreeStock::$rules);
        if($validation->fails()){
            return $redirection
                ->withErrors($validation)
                ->withInput($request->input());
        }
        // Save.
        
        $stockState = $this->UpdateOrSave($request);
        if($stockState){
            $lastId = DB::table('entree_stocks')->insertGetId($entreeStock->toArray());
            $state = $this->saveDetail($lastId, $request);
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
        }else{
            $errors = Array(
                'msg' => ['Stock event is not save.']
            );
            return $redirection
                ->withErrors($errors)
                ->withInput($request->input());
        }
        
    }
    
    /**
     * Function to update stock.
     */
    private function updateOrSave(Request $request): bool
    {
        $refPeremMag = ((string)$request->reference) . $request->datePeremption . $request->magDestination;
        $stock = Stockage::find($refPeremMag);
        if($stock !== null) {
            $newQte = $stock->qteStock + $request->qtEntree;
            return $stock->update(['qteStock' => $newQte]);
        } else {
            $currentStock = new Stockage;
            $currentStock->produit = $request->idProduit;
            $currentStock->magasinStockage = $request->magDestination;
            $currentStock->qteStock = $request->qtEntree;
            $currentStock->refPro = $request->reference;
            $currentStock->datePeremption = $request->datePeremption;
            $currentStock->refProDatePeremptionProduitMaga = $refPeremMag;
            return $currentStock->save();
        }
    }

    private function setData (EntreeStock $entreeStock, Request $request)
    {
        $entreeStock->dateEntree = $request->dateEntree;
        $entreeStock->fournisseur = $request->fournisseur;
        $entreeStock->magOrigine = $request->magOrigine;
        $entreeStock->magDestination = $request->magDestination;
        $entreeStock->motifEntree = $request->motifEntree;
        $entreeStock->client = '';
        $entreeStock->ajouterParE = '1'; // Set current user.
        $entreeStock->modifierParE = '1'; // Set current user.
        $entreeStock->dateModiE = now();
        $entreeStock->supprimerParS = ''; // Set current user.
        $entreeStock->dateSupp = now();
        $entreeStock->selecteur = $request->selecteur;
    }

    /**
     * Fonction qui permet de sauvegarder un nouveau details d'entré.
     */
    private function saveDetail(int $id, Request $request): bool
    {
        $detailEntree = new DetailleEntree;
        $detailEntree->idProduit = $request->idProduit;
        $detailEntree->idEntree = $id;
        $detailEntree->qtEntree = $request->qtEntree;
        $detailEntree->datePeremption = $request->datePeremption;
        $detailEntree->reference = $request->reference;
        $detailEntree->qteEntree2 = 0;
        $detailEntree->prixAchat = $request->prixAchat;
        $detailEntree->observation = $request->observation;
        $detailEntree->magEntree = $request->magDestination;
        $detailEntree->save();
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntreeStock  $entreeStock
     * @return \Illuminate\Http\Response
     */
    public function show(EntreeStock $entreeStock)
    {
        $result = Array(
            'status' => 'OK',
            'record' => $entreeStock
        );
        return response($result, 200);
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
        $result = Array(
            'status' => 'ok',
            'records' => $entreeStock->delete(),
        );
        return response($result, 200);
    }
}
