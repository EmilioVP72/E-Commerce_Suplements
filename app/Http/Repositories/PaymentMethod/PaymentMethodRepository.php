<?php

namespace App\Http\Repositories\PaymentMethod;

use App\Models\Payment_Method;

class PaymentMethodRepository
{
    protected $paymentMethod;

    public function __construct(Payment_Method $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function all()
    {
        return $this->paymentMethod->get();
    }

    public function find($id)
    {
        return $this->paymentMethod->find($id);
    }

    public function create(array $data)
    {
        return $this->paymentMethod->create($data);
    }

    public function update($id, array $data)
    {
        $paymentMethod = $this->find($id);
        $paymentMethod?->update($data);
        return $paymentMethod;
    }

    public function delete($id)
    {
        $paymentMethod = $this->find($id);
        return $paymentMethod?->delete();
    }
}
