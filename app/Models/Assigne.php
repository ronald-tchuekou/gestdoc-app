<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assigne extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignePar', 'courier_id', 'user_id', 'tache', 'date', 'position', 'terminer',
    ];

    public function assigner () {
        return $this->belongsTo(User::class, 'id', 'assignePar');
    }

    public function courier () {
        return $this->belongsTo(Courier::class);
    }

    public function agent() {
        return $this->belongsTo(User::class);
    }
    
}
