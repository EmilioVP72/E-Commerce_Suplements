<?php

namespace App\Http\Repositories\Rol;

use App\Models\Rol;

class RolRepository
{
    protected $rol;

    public function __construct(Rol $rol)
    {
        $this->rol = $rol;
    }

    public function all()
    {
        return $this->rol->get();
    }

    public function find($id)
    {
        return $this->rol->find($id);
    }

    public function create(array $data)
    {
        return $this->rol->create($data);
    }

    public function update($id, array $data)
    {
        $rol = $this->find($id);
        $rol?->update($data);
        return $rol;
    }

    public function delete($id)
    {
        $rol = $this->find($id);
        return $rol?->delete();
    }
}
