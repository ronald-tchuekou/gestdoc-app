<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailleEntree extends Model
{
    use HasFactory;

    protected $fillable = [
        'idProduit',
        'idEntree',
        'qtEntree',
        'datePeremption',
        'reference',
        'qteEntree2',
        'prixAchat',
        'observation',
        'magEntree'
    ];

    public static $rules = [
        'idProduit' => 'required',
        'idEntree' => 'required',
        'qtEntree' => 'required',
        'datePeremption' => 'required',
        'reference' => 'required',
        'qteEntree2' => 'required',
        'prixAchat' => 'required',
        'observation' => 'required',
        'magEntree' => 'required',
    ];

    /**
     * Function qui retourn le prodult.
     */
    public function get_product () {
        return $this->hasOne('App\Models\Product', 'idProduct');
    }
    
    /**
     * Function qui retourne l'entrée en stock correspondant.
     */
    public function get_entree () {
        return $this->hasOne('App\Models\EntreeStock', 'idEntree');
    }
}
