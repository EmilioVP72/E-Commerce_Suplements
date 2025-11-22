<?php

namespace App\Http\Resources\TransactionDetail;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionDetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_transaction' => $this->id_transaction,
            'id_product' => $this->id_product,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
