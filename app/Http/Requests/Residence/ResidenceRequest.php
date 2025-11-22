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
                    'address' => 'required|string|max:255',
                    'city' => 'required|string|max:255',
                    'state' => 'required|string|max:255',
                    'zip_code' => 'required|string|max:10',
                    'country' => 'required|string|max:255',
                ];

            case 'PUT':
                return [
                    'address' => 'sometimes|required|string|max:255',
                    'city' => 'sometimes|required|string|max:255',
                    'state' => 'sometimes|required|string|max:255',
                    'zip_code' => 'sometimes|required|string|max:10',
                    'country' => 'sometimes|required|string|max:255',
                ];

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'address.required' => 'La dirección es obligatoria.',
            'city.required' => 'La ciudad es obligatoria.',
            'state.required' => 'El estado es obligatorio.',
            'zip_code.required' => 'El código postal es obligatorio.',
            'country.required' => 'El país es obligatorio.',
        ];
    }
}
