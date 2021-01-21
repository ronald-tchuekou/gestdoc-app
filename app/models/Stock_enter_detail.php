<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Stock_enter_detail extends Model
{
    protected $fillable = ['enter_id', 'product_id', 'mag_des_id', 'exp_date', 'qte_enter', 'sal_prise'];
}
