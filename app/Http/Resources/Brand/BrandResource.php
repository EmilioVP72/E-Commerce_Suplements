<?php

namespace App\Http\Resources\Brand;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_brand' => $this->id_brand,
            'brand' => $this->brand,
            'id_supplier' => $this->id_supplier,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}