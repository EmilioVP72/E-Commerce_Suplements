<?php

namespace App\Http\Controllers\TransactionDetail;

use App\Http\Controllers\Controller;
use App\Models\Transaction_Detail;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionDetailPageController extends Controller
{
    public function index()
    {
        $transactionDetails = Transaction_Detail::with(['transaction', 'product'])->get();
        return view('transaction_details.index', compact('transactionDetails'));
    }

    public function create()
    {
        $transactions = Transaction::all();
        $products = Product::all();
        return view('transaction_details.create', compact('transactions', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_transaction' => 'required|integer|exists:transaction,id_transaction',
            'id_product' => 'required|integer|exists:product,id_product',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        Transaction_Detail::create($request->all());

        return redirect()->route('transaction_details.index')->with('success', 'Detalle de transacción creado exitosamente.');
    }

    public function edit(Transaction_Detail $transaction_detail)
    {
        $transactions = Transaction::all();
        $products = Product::all();
        return view('transaction_details.edit', compact('transaction_detail', 'transactions', 'products'));
    }

    public function update(Request $request, Transaction_Detail $transaction_detail)
    {
        $request->validate([
            'id_transaction' => 'sometimes|required|integer|exists:transaction,id_transaction',
            'id_product' => 'sometimes|required|integer|exists:product,id_product',
            'quantity' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        $transaction_detail->update($request->all());

        return redirect()->route('transaction_details.index')->with('success', 'Detalle de transacción actualizado exitosamente.');
    }

    public function destroy(Transaction_Detail $transaction_detail)
    {
        $transaction_detail->delete();
        return redirect()->route('transaction_details.index')->with('success', 'Detalle de transacción eliminado exitosamente.');
    }
}
