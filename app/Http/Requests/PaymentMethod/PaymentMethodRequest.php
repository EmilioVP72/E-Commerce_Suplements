<?php

namespace App\Http\Requests\PaymentMethod;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $paymentMethodId = $this->route('id');

        switch ($this->method()) {
            case 'POST':
                return [
                    'payment_method' => 'required|string|max:255|unique:payment_method,payment_method',
                ];

            case 'PUT':
                return [
                    'payment_method' => 'sometimes|required|string|max:255|unique:payment_method,payment_method,' . $paymentMethodId . ',id_payment_method',
                ];

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'payment_method.required' => 'El método de pago es obligatorio.',
            'payment_method.string' => 'El método de pago debe ser una cadena de texto.',
            'payment_method.max' => 'El método de pago no debe superar los 255 caracteres.',
            'payment_method.unique' => 'El método de pago ya está registrado.',
        ];
    }
}
