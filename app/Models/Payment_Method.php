<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment_Method extends Model
{
    protected $table = 'payment_method';
    protected $primaryKey = 'id_payment_method';

    protected $fillable = [
        'payment_method',
    ];

    public function transactionDetails()
    {
        return $this->hasMany(Transaction_Detail::class, 'id_payment_method');
    }
}
