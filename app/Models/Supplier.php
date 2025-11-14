<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    public $timestamps = true;
    
    protected $fillable = [
        'photo',
        'photo_base_64',
        'name',
        'phone',
        'email',
    ];

    public function brand(){
        return $this->hasMany(Brand::class, 'id_supplier', 'id_supplier');
    }
}
