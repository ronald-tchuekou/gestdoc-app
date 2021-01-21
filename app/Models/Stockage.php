<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockage extends Model
{
    use HasFactory;

    protected $primaryKey = 'refProDatePeremptionProduitMaga';

    protected $keyType = 'string';

    protected $fillable = [
        'produit',
        'magasinStockage',
        'qteStock',
        'refPro',
        'datePeremption',
        'refProDatePeremptionProduitMaga',
    ];

    public static $rules = [
        'produit' => 'required',
        'magasinStockage' => 'required',
        'qteStock' => 'required',
        'refPro' => 'required',
        'datePeremption' => 'required',
        'refProDatePeremptionProduitMaga' => 'required',
    ];

    /**
     * function qui retourne le produit correspondant.
     */
    public function product() {
        return $this->hasOne('App\Models\Produit', 'idProduit', 'produit');
    }

    public function magasin() {
        return $this->hasOne('App\Models\Magasin', 'codeMagasin', 'magasinStockage');
    }


}
