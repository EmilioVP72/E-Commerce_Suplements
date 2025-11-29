<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastname1' => $this->lastname1,
            'lastname2' => $this->lastname2,
            'email' => $this->email,
            'phone' => $this->phone,
            'photo' => $this->photo ? asset('storage/' . $this->photo) : null,
            'photo_path' => $this->photo,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
