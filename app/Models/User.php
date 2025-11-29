<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'users';
    public $incrementing = true;

    protected $fillable = [
        'name',
        'lastname1',
        'lastname2',
        'phone',
        'photo',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'user_rol', 'id_user', 'id_rol');
    }

    public function hasRole($roleName)
    {
        return $this->roles->contains('rol', $roleName);
    }

    public function getProfilePhotoUrl()
    {
        return $this->photo ? Storage::url($this->photo) : 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($this->email)));
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id_user');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'id_user');
    }

    public function shoppingCart()
    {
        return $this->hasMany(ShoppingCart::class, 'id_user');
    }

}