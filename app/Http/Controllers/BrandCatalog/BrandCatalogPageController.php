<?php

namespace App\Http\Controllers\BrandCatalog;

use App\Http\Controllers\Controller;
use App\Models\Brand_Catalog;
use App\Models\Brand;
use App\Models\Catalog;
use Illuminate\Http\Request;

class BrandCatalogPageController extends Controller
{
    public function index()
    {
        $brandCatalogs = Brand_Catalog::with(['brand', 'catalog'])->get();
        return view('brand_catalogs.index', compact('brandCatalogs'));
    }

    public function create()
    {
        $brands = Brand::all();
        $catalogs = Catalog::all();
        return view('brand_catalogs.create_form', compact('brands', 'catalogs'));
    }

    public function edit(Request $request, $id_brand)
    {
        $id_catalog = $request->query('id_catalog');
        
        $brandCatalog = Brand_Catalog::where('id_brand', $id_brand)
            ->where('id_catalog', $id_catalog)
            ->firstOrFail();
            
        $brands = Brand::all();
        $catalogs = Catalog::all();
        
        return view('brand_catalogs.update_form', [
            'id_brand' => $id_brand,
            'id_catalog' => $id_catalog,
            'brands' => $brands,
            'catalogs' => $catalogs,
            'brandCatalog' => $brandCatalog,
            'relationBrand' => $id_brand,
            'relationCatalog' => $id_catalog
        ]);
    }

}
