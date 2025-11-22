<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Supplier;

class SupplierPageController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create(){
        return view('suppliers.create_form');
    }

    public function edit(Supplier $supplier){
        return view('suppliers.update_form', ['id' => $supplier->id_supplier]);
    }
}
