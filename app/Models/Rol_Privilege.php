<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol_Privilege extends Model
{
    protected $fillable = [
        'id_rol',
        'id_privilege',
    ];
}
