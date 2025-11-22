<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol_Privilege extends Model
{
    protected $table = 'rol_privilege';
    protected $fillable = [
        'id_rol',
        'id_privilege',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function privilege()
    {
        return $this->belongsTo(Privilege::class, 'id_privilege');
    }
}
