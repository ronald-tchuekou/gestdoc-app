<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrators extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $primaryKey = 'code';
    protected $keyType = 'string';
    protected $incrementing = false;

    static $rules = [
        'code' => 'required',
        'deploy_code' => 'required',
        'name' => 'required',
        'surname' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'sexe' => 'required',
    ];

    /**
     * Fonction qui permet de faire le formatage des champs de type dates.
     */
    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('d M Y H:i:s');
    }

    public function deployement () {
        return $this->belongsTo(Deployements::class);
    }
}
