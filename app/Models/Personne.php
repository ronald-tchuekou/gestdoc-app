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
        'nom' => 'required|min:3|max:20',
        'prenom' => 'required|min:3|max:20',
        'sexe' => 'required',
        'telephone' => 'required|max:20|min:8',
        'cni' => 'required|max:20|min:4',
        'status' => 'required',
    ];


    public function user () {
        return $this->hasOne(User::class);
    }
}

