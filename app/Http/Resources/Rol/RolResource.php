<?php

namespace App\Http\Resources\Rol;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RolResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_rol' => $this->id_rol,
            'rol' => $this->rol,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
