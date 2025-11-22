<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Models\Payment_Method;

class PaymentMethodPageController extends Controller
{
    public function index()
    {
        $paymentMethods = Payment_Method::all();
        return view('payment_methods.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('payment_methods.create_form');
    }

    public function edit(Payment_Method $payment_method)
    {
        return view('payment_methods.update_form', ['id' => $payment_method->id_payment_method]);
    }
}
