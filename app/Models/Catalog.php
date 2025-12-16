<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table = 'catalog';
    protected $primaryKey = 'id_catalog';

    protected $fillable = [
        'catalog',
    ];

    public function brands()
    {
        return $this->hasMany(Brand::class, 'id_catalog', 'id_catalog');
    }
}
