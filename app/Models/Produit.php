<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $primaryKey = 'idProduit';

    protected $fillable = [
        'designation',
        'stockInitial',
        'prixUnitaire',
        'conditionnement',
        'categorie',
        'stockCritique'
    ];

    public static $rules = [
        'designation' => 'required',
        'stockInitial' => 'required',
        'prixUnitaire' => 'required',
        'conditionnement' => 'required',
        'categorie' => 'required',
        'stockCritique' => 'required',
    ];
}
