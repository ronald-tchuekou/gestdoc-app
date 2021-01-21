<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomFournisseur',
        'adresse',
        'telephoneFour',
        'emailFour',
        'nomContrF',
        'regComF'
    ];

    public static $rules = [
        'nomFournisseur' => 'required',
        'adresse' => 'required',
        'telephoneFour' => 'required',
        'emailFour' => 'required',
        'nomContrF' => 'required',
        'regComF' => 'required',
    ];
}
