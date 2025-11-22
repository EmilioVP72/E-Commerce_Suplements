<?php

namespace App\Http\Requests\UserRol;

use Illuminate\Foundation\Http\FormRequest;

class UserRolRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_user' => 'required|integer|exists:users,id_user',
            'id_rol' => 'required|integer|exists:rol,id_rol',
        ];
    }

    public function messages()
    {
        return [
            'id_user.required' => 'El usuario es obligatorio.',
            'id_user.exists' => 'El usuario seleccionado no existe.',
            'id_rol.required' => 'El rol es obligatorio.',
            'id_rol.exists' => 'El rol seleccionado no existe.',
        ];
    }
}
