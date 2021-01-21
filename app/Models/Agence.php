<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'codeAgence',
        'nomAgence',
        'quartier'
    ];
    /**
     * Règle de validation.
     */
    public static $rules = [
        'codeAgence' => 'required|min:5|max:10',
        'nomAgence' => 'required|max:20',
        'quartier' => 'required|max:50',
    ];
}
