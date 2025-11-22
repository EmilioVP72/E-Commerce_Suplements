<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchase';
    protected $primaryKey = 'id_purchase';
    protected $fillable = [
        'id_user',
        'sail_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function purchaseDetails()
    {
        return $this->hasMany(Purchase_Detail::class, 'id_purchase');
    }
    
}
