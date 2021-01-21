<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailVente extends Model
{
    use HasFactory;

    protected $fillable = [
        'idProduit',
        'qteVendue',
        'remise',
        'ligneCom',
        'pu',
        'tva',
        'reference',
        'datePeremptionV',
        'magVente',
        'nomCats',
        'cond',
        'stockInit',
        'stockCrit',
    ];
}
