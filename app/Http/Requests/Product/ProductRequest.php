<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $productId = $this->route('id');

        switch ($this->method()) {
            case 'POST':
                return [
                    'product' => 'required|string|max:255|unique:product,product',
                    'photo' => 'nullable|string',
                    'sale_price' => 'required|numeric|min:0',
                    'purchase_price' => 'required|numeric|min:0',
                    'description' => 'nullable|string',
                    'how_to_use' => 'nullable|string',
                    'warning' => 'nullable|string',
                    'id_brand' => 'required|integer|exists:brand,id_brand',
                ];

            case 'PUT':
                return [
                    'product' => 'sometimes|required|string|max:255|unique:product,product,' . $productId . ',id_product',
                    'photo' => 'nullable|string',
                    'sale_price' => 'sometimes|required|numeric|min:0',
                    'purchase_price' => 'sometimes|required|numeric|min:0',
                    'description' => 'nullable|string',
                    'how_to_use' => 'nullable|string',
                    'warning' => 'nullable|string',
                    'id_brand' => 'sometimes|required|integer|exists:brand,id_brand',
                ];

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'product.required' => 'El nombre del producto es obligatorio.',
            'product.string' => 'El nombre del producto debe ser una cadena de texto.',
            'product.max' => 'El nombre del producto no debe superar los 255 caracteres.',
            'product.unique' => 'El nombre del producto ya está registrado.',

            'photo.string' => 'La foto debe ser una cadena de texto válida.',

            'sale_price.required' => 'El precio de venta es obligatorio.',
            'sale_price.numeric' => 'El precio de venta debe ser un número.',
            'sale_price.min' => 'El precio de venta no puede ser negativo.',

            'purchase_price.required' => 'El precio de compra es obligatorio.',
            'purchase_price.numeric' => 'El precio de compra debe ser un número.',
            'purchase_price.min' => 'El precio de compra no puede ser negativo.',

            'id_brand.required' => 'Debe seleccionar una marca válida.',
            'id_brand.exists' => 'La marca seleccionada no existe.',
        ];
    }
}
