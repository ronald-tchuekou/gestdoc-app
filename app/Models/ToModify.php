<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToModify extends Model
{
    use HasFactory;

    protected $fillable = [
        'courier_id',
        'reason',
        'user_id',
    ];

    public function courier () {
        return $this->belongsTo(Courier::class);
    }

    public function author(){
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
