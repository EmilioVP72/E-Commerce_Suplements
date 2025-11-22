<?php

namespace App\Http\Requests\TransactionDetail;

use Illuminate\Foundation\Http\FormRequest;

class TransactionDetailRequest extends FormRequest
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
                    'id_transaction' => 'required|integer|exists:transaction,id_transaction',
                    'id_product' => 'required|integer|exists:product,id_product',
                    'quantity' => 'required|integer|min:1',
                    'price' => 'required|numeric|min:0',
                ];

            case 'PUT':
                return [
                    'id_transaction' => 'sometimes|required|integer|exists:transaction,id_transaction',
                    'id_product' => 'sometimes|required|integer|exists:product,id_product',
                    'quantity' => 'sometimes|required|integer|min:1',
                    'price' => 'sometimes|required|numeric|min:0',
                ];

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'id_transaction.required' => 'La transacción es obligatoria.',
            'id_transaction.exists' => 'La transacción no existe.',
            'id_product.required' => 'El producto es obligatorio.',
            'id_product.exists' => 'El producto no existe.',
            'quantity.required' => 'La cantidad es obligatoria.',
            'quantity.integer' => 'La cantidad debe ser un número entero.',
            'quantity.min' => 'La cantidad debe ser mayor que 0.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio debe ser mayor que 0.',
        ];
    }
}
