<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;

    protected $fillable = [
        'dateVente',
        'idClient',
        'remiseTotale',
        'montant',
        'heureC',
        'acompte',
        'precompte',
        'tesponsable',
        'serveur',
        'magasin',
        'impression',
        'gateAnnulation',
        'ajouterPar',
        'modifierPar',
        'supprimerPar',
        'dateModif',
        'heureModif',
    ];
}
