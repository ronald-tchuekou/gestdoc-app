<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSortie extends Model
{
    use HasFactory;

    protected $fillable = [
        'idProduit',
        'qteSortie',
        'referenceP',
        'motifSortie',
        'obserSortie',
        'datePeremptionS',
        'magSortie',
        'magDest'
    ];

    static $rules = [
        'idProduit' => 'required',
        'qteSortie' => 'required',
        'motifSortie' => 'required',
        'obserSortie' => 'required',
        'datePeremptionS' => 'required',
        'magSortie' => 'required',
        'magDest' => 'required',
    ];
}
