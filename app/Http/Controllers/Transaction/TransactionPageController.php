<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionPageController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('transactions.create_form');
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.update_form', ['id' => $transaction->id_transaction]);
    }
}
