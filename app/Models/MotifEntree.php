<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotifEntree extends Model
{
    use HasFactory;

    protected $fillable = [
        'motifEntrees'
    ];

    public static $rules = [
        'motifEntrees' => 'required',
    ];

}
