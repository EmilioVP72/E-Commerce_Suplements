<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_product' => $this->id_product,
            'name' => $this->product,
            'sale_price' => $this->sale_price,
            'photo' => $this->photo,
            'purchase_price' => $this->purchase_price,
            'description' => $this->description,
            'how_to_use' => $this->how_to_use,
            'warning' => $this->warning,
            'brand' => $this->whenLoaded('brand'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
