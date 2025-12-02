<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandCatalog\BrandCatalogController;

/*
|--------------------------------------------------------------------------
| API Routes Brand Catalog
|--------------------------------------------------------------------------
|*/

Route::get('/all', [BrandCatalogController::class, 'index']);
Route::get('/OneBrandCatalog/{id}', [BrandCatalogController::class, 'show']);
Route::post('/StoreBrandCatalog', [BrandCatalogController::class, 'store']);
Route::put('/UpdateBrandCatalog/{id_brand}/{id_catalog}', [BrandCatalogController::class, 'update']);
Route::delete('/DeleteBrandCatalog/{id_brand}/{id_catalog}', [BrandCatalogController::class, 'destroy']);
