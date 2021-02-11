<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reject extends Model
{
    use HasFactory;


    protected $fillable = [
        'courier_id',
        'reason',
    ];
}
