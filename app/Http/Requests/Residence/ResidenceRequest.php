<?php

namespace App\Http\Requests\Residence;

use Illuminate\Foundation\Http\FormRequest;

class ResidenceRequest extends FormRequest
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
                    'zip_code'         => 'required|string|max:100',
                    'state'     => 'required|string|max:150',
                    'city'             => 'required|string|max:250',
                    'address'          => 'required|string|max:500',
                    'extra_directions' => 'nullable|string|max:500',
                ];

            case 'PUT':
                return [
                    'zip_code'         => 'sometimes|required|string|max:100',
                    'state'     => 'sometimes|required|string|max:150',
                    'city'             => 'sometimes|required|string|max:250',
                    'address'          => 'sometimes|required|string|max:500',
                    'extra_directions' => 'nullable|string|max:500',
                ];

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'zip_code.required'         => 'El código postal es obligatorio.',
            'state.required'     => 'El municipio es obligatorio.',
            'city.required'             => 'La ciudad es obligatoria.',
            'address.required'          => 'La dirección es obligatoria.',
        ];
    }
}
