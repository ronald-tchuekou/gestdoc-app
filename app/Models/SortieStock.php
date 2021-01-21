<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortieStock extends Model
{
    use HasFactory;


    protected $fillable = [
        'dateSortie',
        'magasinDestination',
        'magasinOrigine',
        'motifSortie',
        'fourSortie',
        'ajouterParS',
        'ModifierParS',
        'dateModifS',
        'supprimerPare',
        'dateSuppres',
        'selecteurs',
    ];

    public static $rules = [
        'idProduit' => 'required',
        'qtSortie' => 'required',
        'referenceP' => 'required',
        'motifSortie' => 'required',
        'obserSortie' => 'required',
        'datePeremptionS' => 'required',
        'magSortie' => 'required',
        'magDest' => 'required',
        'dateSortie' => 'required',
        'motifSortie' => 'required',
        'selecteur' => 'required',
    ];

    public function get_detailStock() {
        return $this->hasOne('App\Models\DetailSortie', 'idSortie', 'idSortie');
    }

}
