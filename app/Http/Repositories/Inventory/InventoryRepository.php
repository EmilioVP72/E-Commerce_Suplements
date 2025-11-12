<?php

namespace App\Http\Repositories\Inventory;

use App\Models\Inventory;

class InventoryRepository
{
    protected $inventory;

    public function __construct(Inventory $inventory)
    {
        $this->inventory = $inventory;
    }

    public function all()
    {
        return $this->inventory->with('product')->get();
    }

    public function find($id)
    {
        return $this->inventory->with('product')->find($id);
    }

    public function create(array $data)
    {
        return $this->inventory->create($data);
    }

    public function update($id, array $data)
    {
        $inventory = $this->find($id);
        $inventory?->update($data);
        return $inventory;
    }

    public function delete($id)
    {
        $inventory = $this->find($id);
        return $inventory?->delete();
    }
}
