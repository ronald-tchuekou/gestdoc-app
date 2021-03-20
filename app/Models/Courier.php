<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
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
        'objet' => 'required|max:150',
        'prestataire' => 'required',
        'code' => 'required',
        'nbPiece' => 'required',
    ];

    /**
     * Fonction to check if courrier code allready existe.
     */
    public static function chekcIfCodeExist (string $code) {
        $courier = Courier::where('code', $code)->first();
        return $courier != null;
    }

    public function assignes () {
        return $this->hasMany(Assigne::class);
    }

    public function to_modify () {
        return $this->hasOne(ToModify::class);
    }

    public function reject () {
        return $this->hasOne(Reject::class);
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
        return $this->hasOne(CourierValide::class);
    }
}
