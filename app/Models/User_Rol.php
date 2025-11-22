<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Rol extends Model
{
    protected $table = 'user_rol';
    protected $fillable = [
        'id_user',
        'id_rol',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }
}
