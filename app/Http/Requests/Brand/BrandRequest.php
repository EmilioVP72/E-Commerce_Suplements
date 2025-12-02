<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $brandId = $this->route('id');

        switch ($this->method()) {
            case 'POST':
                return [
                    'brand' => 'required|string|max:255|unique:brand,brand',
                    'id_supplier' => 'required|integer|exists:supplier,id_supplier',
                ];

            case 'PUT':
                return [
                    'brand' => 'sometimes|required|string|max:255|unique:brand,brand,' . $brandId . ',id_brand',
                    'id_supplier' => 'sometimes|required|integer|exists:supplier,id_supplier',
                ];

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'brand.required' => 'El nombre de la marca es obligatorio.',
            'brand.string' => 'El nombre de la marca debe ser una cadena de texto.',
            'brand.max' => 'El nombre de la marca no debe superar los 255 caracteres.',
            'brand.unique' => 'El nombre de la marca ya está registrado.',
            'id_supplier.required' => 'El proveedor es obligatorio.',
            'id_supplier.integer' => 'El proveedor debe ser un valor válido.',
            'id_supplier.exists' => 'El proveedor seleccionado no existe.',
        ];
    }
}
