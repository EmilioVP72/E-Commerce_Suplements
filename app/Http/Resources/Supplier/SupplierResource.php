<?php

namespace App\Http\Resources\Supplier;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id_supplier,
            'photo' => $this->photo,
            'photo_base_64' => $this->photo_base_64,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'created_at' => optional($this->created_at)->format('d-m-Y H:i:s'),
            'updated_at' => optional($this->updated_at)->format('d-m-Y H:i:s'),
        ];
    }
}
