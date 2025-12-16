<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    protected $table = 'privilege';
    protected $primaryKey = 'id_privilege';

    protected $fillable = [
        'privilege',
        'description',
    ];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'rol_privilege', 'id_privilege', 'id_rol');
    }
}
