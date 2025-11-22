<?php

namespace App\Http\Controllers\BrandCatalog;

use App\Http\Controllers\Controller;
use App\Models\Brand_Catalog;
use Illuminate\Http\Request;

class BrandCatalogPageController extends Controller
{
    public function index()
    {
        $brandCatalogs = Brand_Catalog::with(['brand', 'catalog'])->get();
        return view('brand_catalog.index', compact('brandCatalogs'));
    }
}
