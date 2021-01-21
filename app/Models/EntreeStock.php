<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntreeStock extends Model
{
    use HasFactory;

    protected $primaryKey = 'idEntree';

    protected $fillable = [
        'dateEntree',
        'fournisseur',
        'magOrigine',
        'magDestination',
        'motifEntree',
        'client',
        'ajouterParE',
        'modifierParE',
        'dateModiE',
        'supprimerParS',
        'dateSupp',
        'selecteur'
    ];

    public static $rules = [
        'dateEntree' => 'required',
        'reference' => 'required',
        'prixAchat' => 'required',
        'fournisseur' => 'required',
        'magOrigine' => 'required',
        'magDestination' => 'required',
        'motifEntree' => 'required',
        'idProduit' => 'required',
        'datePeremption' => 'required',
        'selecteur' => 'required',
        'qtEntree' => 'required',
        'observation' => 'required',
    ];

    public function get_detailStock() {
        return $this->hasOne('App\Models\DetailleEntree', 'idEntree', 'idEntree');
    }
    
    public function get_fournisseur () {
        return $this->hasOne('App\Models\Fournisseur', 'idFournisseur', 'fournisseur');
    }

    public function get_Origine_magasin() {
        return $this->hasOne('App\Models\Magasin', 'codeMagasin', 'magOrigine');
    }

    public function get_Destination_magasin () {
        return $this->hasOne('App\Models\Magasin', 'codeMagasin', 'magDestination');
    }

    public function get_client() {
        return $this->hasOne('App\Models\Client', 'idClient', 'client');
    }
}
