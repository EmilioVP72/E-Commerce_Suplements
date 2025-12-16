<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Residence\ResidenceController;

/*
|--------------------------------------------------------------------------
| API Routes Residence
|--------------------------------------------------------------------------
|*/

Route::get('/all', [ResidenceController::class, 'index']);
Route::get('/OneResidence/{id}', [ResidenceController::class, 'show']);
Route::post('/StoreResidence', [ResidenceController::class, 'store']);
Route::put('/UpdateResidence/{id}', [ResidenceController::class, 'update']);
Route::delete('/DeleteResidence/{id}', [ResidenceController::class, 'destroy']);
