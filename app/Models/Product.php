<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id_product';
    public $timestamps = true;

    protected $fillable = [
        'product',
        'photo',
        'sale_price',
        'purchase_price',
        'description',
        'how_to_use',
        'warning',
        'id_brand',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand', 'id_brand');
    }

    public function supplier()
    {
        return $this->hasOneThrough(
            Supplier::class,
            Brand::class,
            'id_brand',   
            'id_supplier', 
            'id_brand',    
            'id_supplier'  
        );
    }
}
