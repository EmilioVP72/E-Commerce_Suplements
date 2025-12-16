<?php

namespace App\Http\Resources\Residence;

use Illuminate\Http\Resources\Json\JsonResource;

class ResidenceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_residence'     => $this->id_residence,
            'zip_code'         => $this->zip_code,
            'state'     => $this->state,
            'city'             => $this->city,
            'address'          => $this->address,
            'extra_directions' => $this->extra_directions,
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at,
        ];
    }
}
