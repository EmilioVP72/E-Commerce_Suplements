<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
                    'transaction_date' => 'required|date',
                ];

            case 'PUT':
                return [
                    'id_user' => 'sometimes|required|integer|exists:users,id',
                    'transaction_date' => 'sometimes|required|date',
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
            'transaction_date.required' => 'La fecha de transacción es obligatoria.',
            'transaction_date.date' => 'La fecha de transacción debe ser una fecha válida.',
        ];
    }
}
