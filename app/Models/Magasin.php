<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magasin extends Model
{
    use HasFactory;

    protected $fillable = [
        'codeMagasin',
        'nomMagasin',
        'codeAgence'
    ];

    public static $rules = [
        'codeMagasin' => 'required',
        'nomMagasin' => 'required',
        'codeAgence' => 'required'
    ];

}
