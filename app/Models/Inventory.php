<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'id_product',
        'quantity',
        'min_quantity',
    ];
}
