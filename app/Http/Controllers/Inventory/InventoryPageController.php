<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryPageController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with(['product', 'supplier'])->get();
        return view('inventory.index', compact('inventories'));
    }
}
