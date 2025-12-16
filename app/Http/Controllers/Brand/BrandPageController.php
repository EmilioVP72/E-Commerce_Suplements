<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Supplier;

class BrandPageController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('brands.create_form', compact('suppliers'));
    }

    public function edit(Brand $brand)
    {
        $suppliers = Supplier::all();
        return view('brands.update_form', ['id' => $brand->id_brand, 'suppliers' => $suppliers]);
    }
}
