<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockage extends Model
{
    use HasFactory;

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
    public function get_product() {
        return $this->hasOne('App\Models\Produit', 'produit');
    }
}
