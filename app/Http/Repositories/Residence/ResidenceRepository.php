<?php

namespace App\Http\Repositories\Residence;

use App\Models\Residence;

class ResidenceRepository
{
    protected $residence;

    public function __construct(Residence $residence)
    {
        $this->residence = $residence;
    }

    public function all()
    {
        return $this->residence->get();
    }

    public function find($id)
    {
        return $this->residence->find($id);
    }

    public function create(array $data)
    {
        return $this->residence->create($data);
    }

    public function update($id, array $data)
    {
        $residence = $this->find($id);
        $residence?->update($data);
        return $residence;
    }

    public function delete($id)
    {
        $residence = $this->find($id);
        return $residence?->delete();
    }
}
