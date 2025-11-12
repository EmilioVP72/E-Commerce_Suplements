<?php

namespace App\Http\Requests\Privilege;

use Illuminate\Foundation\Http\FormRequest;

class PrivilegeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $privilegeId = $this->route('id');

        switch ($this->method()) {
            case 'POST':
                return [
                    'privilege' => 'required|string|max:255|unique:privilege,privilege',
                    'description' => 'required|string|max:255',
                ];
            case 'PUT':
                return [
                    'privilege' => 'sometimes|required|string|max:255|unique:privilege,privilege,' . $privilegeId . ',id_privilege',
                    'description' => 'sometimes|required|string|max:255',
                ];
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'privilege.required' => 'El nombre del privilegio es obligatorio.',
            'privilege.unique' => 'El nombre del privilegio ya está en uso.',
        ];
    }
}
