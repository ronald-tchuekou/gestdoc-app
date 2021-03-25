<?php

namespace App\Models;

use DateTimeInterface;
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
        'localisation' =>  'required',
    ];


    public function user () {
        return $this->hasOne(User::class);
    }
    
    /**
     * Pour la sérialisation des dates.
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y H:i');
    }
    
}

