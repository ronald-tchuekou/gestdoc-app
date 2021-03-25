<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierValide extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'courier_id',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function courier() {
        return $this->belongsTo(Courier::class);
    }
    
    /**
     * Pour la sérialisation des dates.
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y H:i');
    }
    
}
