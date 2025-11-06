<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol';
    protected $primaryKey = 'id_rol';

    protected $fillable = [
        'rol',
    ];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'user_rol', 'id_rol', 'id_user');
    }

    public function privilegios()
    {
        return $this->belongsToMany(Privilege::class, 'rol_privilege', 'id_rol', 'id_privilege');
    }
}
