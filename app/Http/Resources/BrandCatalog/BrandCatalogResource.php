<?php

namespace App\Http\Resources\BrandCatalog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandCatalogResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_brand' => $this->id_brand,
            'id_catalog' => $this->id_catalog,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
