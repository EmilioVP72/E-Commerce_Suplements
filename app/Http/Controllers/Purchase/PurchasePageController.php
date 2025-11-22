<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;

class PurchasePageController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('user')->get();
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $users = User::all();
        return view('purchases.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|integer|exists:users,id',
            'sail_date' => 'required|date',
        ]);

        Purchase::create($request->all());

        return redirect()->route('purchases.index')->with('success', 'Compra creada exitosamente.');
    }

    public function edit(Purchase $purchase)
    {
        $users = User::all();
        return view('purchases.edit', compact('purchase', 'users'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'id_user' => 'sometimes|required|integer|exists:users,id',
            'sail_date' => 'sometimes|required|date',
        ]);

        $purchase->update($request->all());

        return redirect()->route('purchases.index')->with('success', 'Compra actualizada exitosamente.');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Compra eliminada exitosamente.');
    }
}
