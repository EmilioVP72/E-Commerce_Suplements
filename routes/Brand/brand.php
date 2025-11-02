<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Brand\BrandController;

Route::prefix('brands')->group(function () {
    Route::get('/all', [BrandController::class, 'index']);
    Route::get('/getOne/{id}', [BrandController::class, 'show']);
    Route::post('/StoreBrand', [BrandController::class, 'store']);
    Route::put('/UpdateBrand/{id}', [BrandController::class, 'update']);
    Route::delete('/DeleteBrand/{id}', [BrandController::class, 'destroy']);
});