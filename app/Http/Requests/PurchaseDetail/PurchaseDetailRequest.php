<?php

namespace App\Http\Requests\PurchaseDetail;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseDetailRequest extends FormRequest
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
                    'id_purchase' => 'required|integer|exists:purchase,id_purchase',
                    'id_product' => 'required|integer|exists:product,id_product',
                    'amount' => 'required|numeric|min:0',
                ];

            case 'PUT':
                return [
                    'id_purchase' => 'sometimes|required|integer|exists:purchase,id_purchase',
                    'id_product' => 'sometimes|required|integer|exists:product,id_product',
                    'amount' => 'sometimes|required|numeric|min:0',
                ];

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'id_purchase.required' => 'La compra es obligatoria.',
            'id_purchase.exists' => 'La compra no existe.',
            'id_product.required' => 'El producto es obligatorio.',
            'id_product.exists' => 'El producto no existe.',
            'amount.required' => 'La cantidad es obligatoria.',
            'amount.numeric' => 'La cantidad debe ser un número.',
            'amount.min' => 'La cantidad debe ser mayor que 0.',
        ];
    }
}
