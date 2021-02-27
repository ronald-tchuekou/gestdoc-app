<?php

namespace App\Models;

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

}
