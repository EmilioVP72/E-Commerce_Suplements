<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Catalog; // Importamos el modelo Catalog
use Illuminate\Http\Request;

class CatalogPageController extends Controller
{
    public function index()
    {
        if (request()->is('catalogs*')) {
            $catalogs = Catalog::latest()->get(); 
            return view('catalogs.index', compact('catalogs'));
        }

        $products = Product::with('brand')->latest()->paginate(12);
        return view('catalog.index', compact('products'));
    }
}
