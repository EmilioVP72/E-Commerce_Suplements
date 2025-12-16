<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;

class InventoryPageController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with(['product'])->get();
        return view('inventory.index', compact('inventories'));
    }

    public function create()
    {
        return view('inventory.create_form');
    }

    public function edit(Inventory $inventory)
    {
        return view('inventory.update_form', ['id' => $inventory->id_inventory]);
    }
}
