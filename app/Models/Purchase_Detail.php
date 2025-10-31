<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase_Detail extends Model
{
    protected $fillable = [
        'id_purchase',
        'id_product',
        'amount',
    ];
}
