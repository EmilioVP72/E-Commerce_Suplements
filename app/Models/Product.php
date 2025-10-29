<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product',
        'sale_price',
        'purchase_price',
        'description',
        'how_to_use',
        'warning',
        'id_brand',
    ];
}
