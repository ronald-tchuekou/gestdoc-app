<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assigne extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignePar', 'courier_id', 'user_id', 'tache', 'date', 'position', 'terminer',
    ];

    public function assigner () {
        return $this->hasOne(User::class, 'id', 'assignePar');
    }

    public function courier () {
        return $this->belongsTo(Courier::class);
    }

    public function agent() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    
    /**
     * Pour la sérialisation des dates.
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y H:i');
    }
    
}
