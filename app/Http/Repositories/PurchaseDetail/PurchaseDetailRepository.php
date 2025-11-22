<?php

namespace App\Http\Repositories\PurchaseDetail;

use App\Models\Purchase_Detail;

class PurchaseDetailRepository
{
    protected $purchaseDetail;

    public function __construct(Purchase_Detail $purchaseDetail)
    {
        $this->purchaseDetail = $purchaseDetail;
    }

    public function all()
    {
        return $this->purchaseDetail->get();
    }

    public function find($id)
    {
        return $this->purchaseDetail->find($id);
    }

    public function create(array $data)
    {
        return $this->purchaseDetail->create($data);
    }

    public function update($id, array $data)
    {
        $purchaseDetail = $this->find($id);
        $purchaseDetail?->update($data);
        return $purchaseDetail;
    }

    public function delete($id)
    {
        $purchaseDetail = $this->find($id);
        return $purchaseDetail?->delete();
    }
}
