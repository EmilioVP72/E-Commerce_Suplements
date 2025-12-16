<?php

namespace App\Http\Requests\Catalog;

use Illuminate\Foundation\Http\FormRequest;

class CatalogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $catalogId = $this->route('id');

        switch ($this->method()) {
            case 'POST':
                return [
                    'catalog' => 'required|string|max:255|unique:catalog,catalog',
                    'description' => 'nullable|string',
                ];
            case 'PUT':
                return [
                    'catalog' => 'sometimes|required|string|max:255|unique:catalog,catalog,' . $catalogId . ',id_catalog',
                    'description' => 'nullable|string',
                ];
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'catalog.required' => 'El nombre del catálogo es obligatorio.',
            'catalog.unique' => 'El nombre del catálogo ya está en uso.',
        ];
    }
}
