<?php

namespace App\Http\Repositories\Privilege;

use App\Models\Privilege;

class PrivilegeRepository
{
    protected $privilege;

    public function __construct(Privilege $privilege)
    {
        $this->privilege = $privilege;
    }

    public function all()
    {
        return $this->privilege->get();
    }

    public function find($id)
    {
        return $this->privilege->find($id);
    }

    public function create(array $data)
    {
        return $this->privilege->create($data);
    }

    public function update($id, array $data)
    {
        $privilege = $this->find($id);
        $privilege?->update($data);
        return $privilege;
    }

    public function delete($id)
    {
        $privilege = $this->find($id);
        return $privilege?->delete();
    }
}
