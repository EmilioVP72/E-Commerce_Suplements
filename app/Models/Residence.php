<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
    protected $table = 'residence';
    protected $primaryKey = 'id_residence';
    
    protected $fillable = [
        'address',
        'city',
        'state',
        'zip_code',
        'country',
    ];

    public function residenceUsers()
    {
        return $this->hasMany(Residence_User::class, 'id_residence');
    }
}
