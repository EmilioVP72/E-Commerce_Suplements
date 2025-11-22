<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Purchase;

class PurchasePageController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('user')->get();
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        return view('purchases.create_form');
    }

    public function edit(Purchase $purchase)
    {
        return view('purchases.update_form', ['id' => $purchase->id_purchase]);
    }
}
