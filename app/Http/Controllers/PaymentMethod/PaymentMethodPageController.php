<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Models\Payment_Method;
use Illuminate\Http\Request;

class PaymentMethodPageController extends Controller
{
    public function index()
    {
        $paymentMethods = Payment_Method::all();
        return view('payment_methods.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('payment_methods.create');
    }

    public function store(Request $request)
    {
        $request->validate(['payment_method' => 'required|string|max:255|unique:payment_method']);

        Payment_Method::create($request->all());

        return redirect()->route('payment_methods.index')->with('success', 'Método de pago creado exitosamente.');
    }

    public function edit(Payment_Method $payment_method)
    {
        return view('payment_methods.edit', compact('payment_method'));
    }

    public function update(Request $request, Payment_Method $payment_method)
    {
        $request->validate(['name' => 'required|string|max:255|unique:payment_methods,name,' . $payment_method->id_payment_method . ',id_payment_method']);

        $payment_method->update($request->all());

        return redirect()->route('payment_methods.index')->with('success', 'Método de pago actualizado exitosamente.');
    }

    public function destroy(Payment_Method $payment_method)
    {
        $payment_method->delete();
        return redirect()->route('payment_methods.index')->with('success', 'Método de pago eliminado exitosamente.');
    }
}
