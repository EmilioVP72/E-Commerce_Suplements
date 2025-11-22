<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase_Detail extends Model
{
    protected $table = 'purchase_detail';
    protected $primaryKey = 'id_purchase_detail';
    protected $fillable = [
        'id_purchase',
        'id_product',
        'amount',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'id_purchase');
    }
}
