<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand_Catalog extends Model
{
    protected $table = 'brand_catalog';
    protected $primaryKey = 'id_brand_catalog';
    protected $fillable = [
        'id_brand',
        'id_catalog',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand', 'id_brand');
    }

    public function catalog()
    {
        return $this->belongsTo(Catalog::class, 'id_catalog', 'id_catalog');
    }
}
