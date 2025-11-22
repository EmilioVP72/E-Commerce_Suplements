<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction_Detail extends Model
{
    protected $table = 'transaction_detail';
    protected $fillable = [
        'id_transaction',
        'id_product',
        'quantity',
        'price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_transaction');
    }
}
