<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Catalog;

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

    public function create()
    {
        return view('catalogs.create_form');
    }

    public function edit(Catalog $catalog)
    {
        return view('catalogs.update_form', ['id' => $catalog->id_catalog]);
    }
}
