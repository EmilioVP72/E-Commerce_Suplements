<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $supplierId = $this->route('id');

        switch ($this->method()) {
            case 'POST':
                return [
                    'photo' => 'image|mimes:jpeg,png|max:2048',
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:supplier,email',
                    'phone' => 'required|string|max:20|unique:supplier,phone',
                ];

            case 'PUT':
                return [
                    'photo' => 'image|mimes:jpeg,png|max:2048',
                    'name' => 'sometimes|required|string|max:255',
                    'email' => 'sometimes|required|string|email|max:255|unique:supplier,email,' . $supplierId. ',id_supplier',
                    'phone' => 'sometimes|string|max:20|unique:supplier,phone,'  . $supplierId. ',id_supplier'
                ];

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'photo.mimes' => 'El archivo no es una imagen.',
            'photo.max' => 'El archivo es demasiado grande.',
            'name.required' => 'El nombre del proveedor es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'phone.required' => 'El teléfono es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'name.max' => 'El nombre no debe superar los 255 caracteres.',
        ];
    }
}