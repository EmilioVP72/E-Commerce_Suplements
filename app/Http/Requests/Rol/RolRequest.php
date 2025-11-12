<?php

namespace App\Http\Requests\Rol;

use Illuminate\Foundation\Http\FormRequest;

class RolRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rolId = $this->route('id');

        switch ($this->method()) {
            case 'POST':
                return [
                    'rol' => 'required|string|max:255|unique:rol,rol',
                ];
            case 'PUT':
                return [
                    'rol' => 'sometimes|required|string|max:255|unique:rol,rol,' . $rolId . ',id_rol',
                ];
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'rol.required' => 'El nombre del rol es obligatorio.',
            'rol.unique' => 'El nombre del rol ya está en uso.',
        ];
    }
}
