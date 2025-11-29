<?php

namespace App\Http\Requests\ShoppingCart;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_product' => 'required|exists:product,id_product',
            'quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'id_product.required' => 'El producto es requerido.',
            'id_product.exists' => 'El producto no existe.',
            'quantity.required' => 'La cantidad es requerida.',
            'quantity.integer' => 'La cantidad debe ser un número entero.',
            'quantity.min' => 'La cantidad debe ser mayor a 0.',
        ];
    }
}