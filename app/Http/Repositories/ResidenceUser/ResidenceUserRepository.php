<?php

namespace App\Http\Repositories\ResidenceUser;

use App\Models\Residence_User;

class ResidenceUserRepository
{
    protected $residenceUser;

    public function __construct(Residence_User $residenceUser)
    {
        $this->residenceUser = $residenceUser;
    }

    public function all()
    {
        return $this->residenceUser->get();
    }

    public function find($id)
    {
        return $this->residenceUser->find($id);
    }

    public function create(array $data)
    {
        return $this->residenceUser->create($data);
    }

    public function update($id, array $data)
    {
        $residenceUser = $this->find($id);
        $residenceUser?->update($data);
        return $residenceUser;
    }

    public function delete($id)
    {
        $residenceUser = $this->find($id);
        return $residenceUser?->delete();
    }
}
