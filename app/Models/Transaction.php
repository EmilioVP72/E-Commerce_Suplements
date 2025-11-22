<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id_transaction';

    protected $fillable = [
        'id_user',
        'transaction_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function transactionDetails()
    {
        return $this->hasMany(Transaction_Detail::class, 'id_transaction');
    }   
}
