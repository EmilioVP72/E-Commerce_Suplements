<?php

namespace App\Http\Resources\ShoppingCart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Product\ProductResource;

class ShoppingCartResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_cart' => $this->id_cart,
            'id_product' => $this->id_product,
            'product' => new ProductResource($this->product),
            'quantity' => $this->quantity,
            'subtotal' => $this->product->sale_price * $this->quantity,
        ];
    }
}