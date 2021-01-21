<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Stock_Enter;
use App\models\Stock_enter_detail;
use Illuminate\Http\Response;

class StockEnterController extends Controller
{
    public function index () {
        return view ('home');
    }

    public function store (Request $request) {

        // Validation 
        $request->validate([
            'date' => 'required',
            'fournisseur' => 'required',
            'magasin_id_o' => 'required',
            'motif' => 'required',
            'chooser_table' => 'required',
        ]);

        $date = $request->date;
        $fournisseur = $request->fournisseur;
        $magasin_id_o = $request->magasin_id_o;
        $enter_motif_id = $request->motif;
       
        // Save stock enter.
        $stock_enter = Stock_Enter::create(compact('date', 'fournisseur', 'magasin_id_o', 'enter_motif_id'));

        // Save all this choose produts.
        $chooser_table = $request->chooser_table;
        foreach ($chooser_table as  $value) {
            $enter_id = $value['num_enter'];
            $product_id = $value['designation'];
            $mag_des_id = $value['mag_destination'];
            $exp_date = $request->date;
            $qte_enter = $value['qte_enter'];
            $sal_prise = $value['sal_prise'];
            Stock_enter_detail::create(compact('enter_id', 'product_id', 'mag_des_id',
            'exp_date', 'qte_enter', 'sal_prise'));
        }
        return Response::json(['success' => true, 'message' => 'Data is save successfuly']);
    }

    public function update (Request $request, $id) {
        // TODO
    }
}
