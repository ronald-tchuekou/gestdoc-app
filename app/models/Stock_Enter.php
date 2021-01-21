<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Stock_Enter extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['date', 'fournisseur', 'magasin_id_o', 'enter_motif_id'];
}
