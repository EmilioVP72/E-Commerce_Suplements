<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Supplier\SupplierController;

/*
|--------------------------------------------------------------------------
| API Routes Supplier
|--------------------------------------------------------------------------
|*/
Route::prefix('suppliers')->group(function () {
    Route::get('/all', [SupplierController::class, 'index']);
    Route::get('/OneSupplier/{id}', [SupplierController::class, 'show']);
    Route::post('/StoreSupplier', [SupplierController::class, 'store']);
    Route::put('/UpdateSupplier/{id}', [SupplierController::class, 'update']);
});
