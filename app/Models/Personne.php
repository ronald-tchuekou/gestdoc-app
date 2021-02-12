<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'email',
        'telephone', 
        'cni', 
        'localisation',
        'status'
    ];

    static $rules = [
        'nom' => 'required',
        'prenom' => 'required',
        'sexe' => 'required',
        'telephone' => 'required|max:20|min:8',
        'cni' => 'required|max:20|min:4',
        'status' => 'required',
    ];
}
