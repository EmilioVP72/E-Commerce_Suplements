<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $inventoryId = $this->route('id');

        switch ($this->method()) {
            case 'POST':
                return [
                    'quantity' => 'required|integer|min:0',
                    'min_quantity' => 'required|integer|min:1',
                    'id_product' => 'required|integer|exists:product,id_product|unique:inventory,id_product',
                ];
            case 'PUT':
                return [
                    'quantity' => 'integer|min:0',
                    'min_quantity' => 'integer|min:1',
                    'id_product' => 'sometimes|required|integer|exists:product,id_product|unique:inventory,id_product,' . $inventoryId . ',id_inventory',
                ];
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'quantity.required' => 'La cantidad es obligatoria.',
            'quantity.integer' => 'La cantidad debe ser un número entero.',
            'id_product.required' => 'El producto es obligatorio.',
            'id_product.unique' => 'Este producto ya tiene un registro de inventario.',
        ];
    }
}
