<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $primaryKey = 'codeEmploye';
    protected $keyType = 'varchar(50)';
    public $incrementing = false;

    protected $fillable = [
        'codeEmploye',
        'nomComplet',
        'adresse',
        'telephone',
        'cni',
        'autreContact',
        'emailemp',
        'sonAgence'
    ];

    public static $rules = [
        'codeEmploye' => 'required',
        'nomComplet' => 'required',
        'adresse' => 'required',
        'telephone' => 'required',
        'cni' => 'required',
        'autreContact' => 'required',
        'emailemp' => 'required',
        'sonAgence' => 'required'
    ];
}
