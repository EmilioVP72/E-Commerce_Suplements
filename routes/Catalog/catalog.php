<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Catalog\CatalogController;

/*
|--------------------------------------------------------------------------
| API Routes Catalog
|--------------------------------------------------------------------------
|*/
Route::prefix('catalogs')->group(function () {
    Route::get('/all', [CatalogController::class, 'index']);
    Route::get('/OneCatalog/{id}', [CatalogController::class, 'show']);
    Route::post('/StoreCatalog', [CatalogController::class, 'store']);
    Route::put('/UpdateCatalog/{id}', [CatalogController::class, 'update']);
    Route::delete('/DeleteCatalog/{id}', [CatalogController::class, 'destroy']);
});
