<?php

namespace App\Http\Resources\Privilege;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivilegeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id_privilege' => $this->id_privilege,
            'privilege' => $this->privilege,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
