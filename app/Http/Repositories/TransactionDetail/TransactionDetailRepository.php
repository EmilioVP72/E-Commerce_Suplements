<?php

namespace App\Http\Repositories\TransactionDetail;

use App\Models\Transaction_Detail;

class TransactionDetailRepository
{
    protected $transactionDetail;

    public function __construct(Transaction_Detail $transactionDetail)
    {
        $this->transactionDetail = $transactionDetail;
    }

    public function all()
    {
        return $this->transactionDetail->get();
    }

    public function find($id)
    {
        return $this->transactionDetail->find($id);
    }

    public function create(array $data)
    {
        return $this->transactionDetail->create($data);
    }

    public function update($id, array $data)
    {
        $transactionDetail = $this->find($id);
        $transactionDetail?->update($data);
        return $transactionDetail;
    }

    public function delete($id)
    {
        $transactionDetail = $this->find($id);
        return $transactionDetail?->delete();
    }
}
