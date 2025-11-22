<?php

namespace App\Http\Resources\Residence;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResidenceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_residence' => $this->id_residence,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
            'country' => $this->country,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
