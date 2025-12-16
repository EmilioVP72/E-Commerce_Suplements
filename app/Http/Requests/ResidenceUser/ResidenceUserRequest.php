<?php

namespace App\Http\Requests\ResidenceUser;

use Illuminate\Foundation\Http\FormRequest;

class ResidenceUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'id_user' => 'required|integer|exists:users,id',
                    'id_residence' => 'required|integer|exists:residence,id_residence',
                ];

            case 'PUT':
                return [
                    'id_user' => 'sometimes|required|integer|exists:users,id',
                    'id_residence' => 'sometimes|required|integer|exists:residence,id_residence',
                ];

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'id_user.required' => 'El usuario es obligatorio.',
            'id_user.exists' => 'El usuario seleccionado no existe.',
            'id_residence.required' => 'La residencia es obligatoria.',
            'id_residence.exists' => 'La residencia seleccionada no existe.',
        ];
    }
}
