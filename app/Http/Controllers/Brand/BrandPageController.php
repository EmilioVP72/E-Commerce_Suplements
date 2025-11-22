<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandPageController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        return view('brands.create_form');
    }

    public function edit(Brand $brand)
    {
        return view('brands.update_form', ['id' => $brand->id_brand]);
    }
}
