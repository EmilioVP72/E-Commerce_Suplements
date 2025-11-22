<?php

namespace App\Http\Controllers\BrandCatalog;

use App\Http\Controllers\Controller;
use App\Models\Brand_Catalog;

class BrandCatalogPageController extends Controller
{
    public function index()
    {
        $brandCatalogs = Brand_Catalog::with(['brand', 'catalog'])->get();
        return view('brand_catalog.index', compact('brandCatalogs'));
    }

    public function create()
    {
        return view('brand_catalogs.create_form');
    }

    public function edit(Brand_Catalog $brand_catalog)
    {
        return view('brand_catalogs.update_form', ['id' => $brand_catalog->id_brand_catalog]);
    }
}
