<?php

namespace App\Http\Repositories\Brand;

use App\Models\Brand;

class BrandRepository
{
    protected $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function all()
    {
        return $this->brand->get();
    }

    public function find($id)
    {
        return $this->brand->find($id);
    }

    public function create(array $data)
    {
        return $this->brand->create($data);
    }

    public function update($id, array $data)
    {
        $brand = $this->find($id);
        $brand?->update($data);
        return $brand;
    }

    public function delete($id)
    {
        $brand = $this->find($id);
        return $brand?->delete();
    }
}