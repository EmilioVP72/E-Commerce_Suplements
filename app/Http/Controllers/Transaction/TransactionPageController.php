<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionPageController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $users = User::all();
        return view('transactions.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|integer|exists:users,id',
            'transaction_date' => 'required|date',
        ]);

        Transaction::create($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transacción creada exitosamente.');
    }

    public function edit(Transaction $transaction)
    {
        $users = User::all();
        return view('transactions.edit', compact('transaction', 'users'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'id_user' => 'sometimes|required|integer|exists:users,id',
            'transaction_date' => 'sometimes|required|date',
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transacción actualizada exitosamente.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transacción eliminada exitosamente.');
    }
}
