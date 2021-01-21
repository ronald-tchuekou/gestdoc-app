<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillabe = [
        'nomClient',
        'adresse',
        'telephoneClient',
        'emailClient',
        'nomContr',
        'registCom',
        'agences',
        'categorieClient',
        'avoirs'
    ];

    public static $rules = Array(
        'nomClient' => 'required',
        'adresse' => 'required',
        'telephoneClient' => 'required',
        'emailClient' => 'required',
        'numContr' => 'required',
        'registCom' => 'required',
        'agences' => 'required',
        'categorieClient' => 'required',
        'avoirs' => 'required',
    );

    public function category(){
        return $this->hasOne('App\Models\CategorieClient', 'idCatClient', 'categorieClient');
    }

    public function agence () {
        return $this->hasOne('App\Models\Agence', 'codeAgence', 'agences');
    }
}
