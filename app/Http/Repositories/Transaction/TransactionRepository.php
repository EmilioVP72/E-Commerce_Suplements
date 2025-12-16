<?php

namespace App\Http\Repositories\Transaction;

use App\Models\Transaction;

class TransactionRepository
{
    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function all()
    {
        return $this->transaction->get();
    }

    public function find($id)
    {
        return $this->transaction->find($id);
    }

    public function create(array $data)
    {
        return $this->transaction->create($data);
    }

    public function update($id, array $data)
    {
        $transaction = $this->find($id);
        $transaction?->update($data);
        return $transaction;
    }

    public function delete($id)
    {
        $transaction = $this->find($id);
        return $transaction?->delete();
    }
}
