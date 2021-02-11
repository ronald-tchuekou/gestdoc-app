<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie_id',
        'service_id',
        'personne_id',
        'objet',
        'prestataire',
        'dateEnregistrement',
        'tache',
        'recommandation',
        'observation',
        'nbPiece',
        'etat'
    ];

    static $rules = [
        'categorie_id' => 'required',
        'objet' => 'required',
        'prestataire' => 'required',
        'observation' => 'required',
        'nbPiece' => 'required',
    ];

    public function assignes () {
        return $this->hasMany(Assigne::class);
    }

    public function assignes_users () {
        return $this->belongsToMany(User::class, 'assignes');
    }

    public function categorie () {
        return $this->belongsTo(Categorie::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function service () {
        return $this->belongsTo(Service::class);
    }

    public function personne () {
        return $this->belongsTo(Personne::class);
    }

    public function valide() {
        return $this->belongsTo(CourierValide::class);
    }
}
