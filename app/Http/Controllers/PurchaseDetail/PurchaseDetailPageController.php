<?php

namespace App\Http\Controllers\PurchaseDetail;

use App\Http\Controllers\Controller;
use App\Models\Purchase_Detail;

class PurchaseDetailPageController extends Controller
{
    public function index()
    {
        $purchaseDetails = Purchase_Detail::with(['purchase', 'product'])->get();
        return view('purchase_details.index', compact('purchaseDetails'));
    }

    public function create()
    {
        return view('purchase_details.create_form');
    }

    public function edit(Purchase_Detail $purchase_detail)
    {
        return view('purchase_details.update_form', ['id' => $purchase_detail->id_purchase_detail]);
    }
}
