<?php

namespace App\Http\Resources\ResidenceUser;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResidenceUserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_residence_user' => $this->id_residence_user,
            'id_user' => $this->id_user,
            'id_residence' => $this->id_residence,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
