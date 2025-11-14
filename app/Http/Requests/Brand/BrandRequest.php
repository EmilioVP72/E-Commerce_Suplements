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
                    'name' => 'required|string|max:255|unique:brands,name',
                ];

            case 'PUT':
                return [
                    'brand' => 'sometimes|required|string|max:255|unique:brand,brand,' . $brandId . ',id_brand',
                    'name' => 'sometimes|required|string|max:255|unique:brands,name,' . $brandId . ',id_brand',
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
            'name.required' => 'El nombre de la marca es obligatorio.',
            'name.unique' => 'El nombre de la marca ya está en uso.',
        ];
    }
}
