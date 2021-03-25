<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deployements extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $primaryKey = 'code';
    protected $keyType = 'string';
    protected $incrementing = false;

    public static $rules = [
        'code' => 'required',
        'location' => 'required',
        'licence' => 'required',
        'date_end' => 'required',
        'pay_plan' => 'required',
    ];

    /**
     * Fonction qui permet de faire le formatage des champs de type dates.
     */
    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('d M Y H:i:s');
    }

    public function administrator () {
        return $this->belongsTo(Administrators::class);
    }
}
