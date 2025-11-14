<?php

namespace App\Http\Requests\RolPrivilege;

use Illuminate\Foundation\Http\FormRequest;

class RolPrivilegeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_rol' => 'required|integer|exists:rol,id_rol',
            'id_privilege' => 'required|integer|exists:privilege,id_privilege',
        ];
    }

    public function messages()
    {
        return [
            'id_rol.required' => 'El rol es obligatorio.',
            'id_rol.exists' => 'El rol seleccionado no existe.',
            'id_privilege.required' => 'El privilegio es obligatorio.',
            'id_privilege.exists' => 'El privilegio seleccionado no existe.',
        ];
    }
}
