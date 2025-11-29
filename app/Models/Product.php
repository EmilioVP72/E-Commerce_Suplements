<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function transactionDetails()
    {
        return $this->hasMany(Transaction_Detail::class, 'id_product');
    }

    public function purchaseDetails()
    {
        return $this->hasMany(Purchase_Detail::class, 'id_product');
    }

    public function inventory(): HasOne
    {
        return $this->hasOne(Inventory::class, 'id_product', 'id_product');
    }
}
