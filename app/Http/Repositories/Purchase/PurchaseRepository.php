<?php

namespace App\Http\Repositories\Purchase;

use App\Models\Purchase;

class PurchaseRepository
{
    protected $purchase;

    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    public function all()
    {
        return $this->purchase->get();
    }

    public function find($id)
    {
        return $this->purchase->find($id);
    }

    public function create(array $data)
    {
        return $this->purchase->create($data);
    }

    public function update($id, array $data)
    {
        $purchase = $this->find($id);
        $purchase?->update($data);
        return $purchase;
    }

    public function delete($id)
    {
        $purchase = $this->find($id);
        return $purchase?->delete();
    }
}
