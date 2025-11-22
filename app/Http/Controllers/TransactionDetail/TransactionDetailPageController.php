<?php

namespace App\Http\Controllers\TransactionDetail;

use App\Http\Controllers\Controller;
use App\Models\Transaction_Detail;

class TransactionDetailPageController extends Controller
{
    public function index()
    {
        $transactionDetails = Transaction_Detail::with(['transaction', 'product'])->get();
        return view('transaction_details.index', compact('transactionDetails'));
    }

    public function create()
    {
        return view('transaction_details.create_form');
    }

    public function edit(Transaction_Detail $transaction_detail)
    {
        return view('transaction_details.update_form', ['id' => $transaction_detail->id_transaction_detail]);
    }
}
