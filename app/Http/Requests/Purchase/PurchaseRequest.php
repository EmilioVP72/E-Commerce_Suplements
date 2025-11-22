<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
                    'sail_date' => 'required|date',
                ];

            case 'PUT':
                return [
                    'id_user' => 'sometimes|required|integer|exists:users,id',
                    'sail_date' => 'sometimes|required|date',
                ];

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'id_user.required' => 'El usuario es obligatorio.',
            'id_user.exists' => 'El usuario no existe.',
            'sail_date.required' => 'La fecha de venta es obligatoria.',
            'sail_date.date' => 'La fecha de venta debe ser una fecha válida.',
        ];
    }
}
