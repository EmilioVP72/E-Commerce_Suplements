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

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id_supplier');
    }

    public function catalog()
    {
        return $this->belongsTo(Catalog::class, 'id_catalog', 'id_catalog');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id_brand', 'id_brand');
    }
}
