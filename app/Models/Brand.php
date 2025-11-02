<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $primaryKey = 'id_brand';

    protected $fillable = [
        'brand',
        'description'
    ];
}
