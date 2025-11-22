<?php

namespace App\Http\Requests\BrandCatalog;

use Illuminate\Foundation\Http\FormRequest;

class BrandCatalogRequest extends FormRequest
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
                    'id_brand' => 'required|integer|exists:brand,id_brand',
                    'id_catalog' => 'required|integer|exists:catalog,id_catalog',
                ];

            case 'PUT':
                return [
                    'id_brand' => 'sometimes|required|integer|exists:brand,id_brand',
                    'id_catalog' => 'sometimes|required|integer|exists:catalog,id_catalog',
                ];

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'id_brand.required' => 'La marca es obligatoria.',
            'id_brand.exists' => 'La marca no existe.',
            'id_catalog.required' => 'El catálogo es obligatorio.',
            'id_catalog.exists' => 'El catálogo no existe.',
        ];
    }
}
