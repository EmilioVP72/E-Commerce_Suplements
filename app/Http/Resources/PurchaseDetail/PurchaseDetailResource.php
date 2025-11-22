<?php

namespace App\Http\Resources\PurchaseDetail;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseDetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_purchase' => $this->id_purchase,
            'id_product' => $this->id_product,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
