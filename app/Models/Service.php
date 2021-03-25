<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'intitule',
    ];

    
    /**
     * Pour la sérialisation des dates.
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y H:i');
    }
    
}
