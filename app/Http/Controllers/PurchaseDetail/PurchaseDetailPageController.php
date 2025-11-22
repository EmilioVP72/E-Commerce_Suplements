<?php

namespace App\Http\Controllers\PurchaseDetail;

use App\Http\Controllers\Controller;
use App\Models\Purchase_Detail;
use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Http\Request;

class PurchaseDetailPageController extends Controller
{
    public function index()
    {
        $purchaseDetails = Purchase_Detail::with(['purchase', 'product'])->get();
        return view('purchase_details.index', compact('purchaseDetails'));
    }

    public function create()
    {
        $purchases = Purchase::all();
        $products = Product::all();
        return view('purchase_details.create', compact('purchases', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_purchase' => 'required|integer|exists:purchase,id_purchase',
            'id_product' => 'required|integer|exists:product,id_product',
            'amount' => 'required|numeric|min:0',
        ]);

        Purchase_Detail::create($request->all());

        return redirect()->route('purchase_details.index')->with('success', 'Detalle de compra creado exitosamente.');
    }

    public function edit(Purchase_Detail $purchase_detail)
    {
        $purchases = Purchase::all();
        $products = Product::all();
        return view('purchase_details.edit', compact('purchase_detail', 'purchases', 'products'));
    }

    public function update(Request $request, Purchase_Detail $purchase_detail)
    {
        $request->validate([
            'id_purchase' => 'sometimes|required|integer|exists:purchase,id_purchase',
            'id_product' => 'sometimes|required|integer|exists:product,id_product',
            'amount' => 'sometimes|required|numeric|min:0',
        ]);

        $purchase_detail->update($request->all());

        return redirect()->route('purchase_details.index')->with('success', 'Detalle de compra actualizado exitosamente.');
    }

    public function destroy(Purchase_Detail $purchase_detail)
    {
        $purchase_detail->delete();
        return redirect()->route('purchase_details.index')->with('success', 'Detalle de compra eliminado exitosamente.');
    }
}
