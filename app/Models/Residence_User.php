<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Residence_User extends Model
{
    protected $table = 'residence_user';
    protected $primaryKey = 'id_residence_user';
    protected $fillable = [
        'id_user',
        'id_residence',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function residence()
    {
        return $this->belongsTo(Residence::class, 'id_residence');
    }
}
