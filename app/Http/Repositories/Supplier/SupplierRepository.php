<?php

namespace App\Http\Repositories\Supplier;

use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class SupplierRepository
{
    protected $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function all()
    {
        return $this->supplier->get();
    }

    public function find($id)
    {
        return $this->supplier->find($id);
    }

    public function create(array $data)
    {
        return $this->supplier->create($data);
    }

    public function update($id, array $data)
    {
        $supplier = $this->find($id);
        $supplier?->update($data);
        return $supplier;
    }
}