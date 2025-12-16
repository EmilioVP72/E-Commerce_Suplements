<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidenceUser\ResidenceUserController;

/*
|--------------------------------------------------------------------------
| API Routes Residence User
|--------------------------------------------------------------------------
|*/

Route::get('/all', [ResidenceUserController::class, 'index']);
Route::get('/OneResidenceUser/{id}', [ResidenceUserController::class, 'show']);
Route::post('/StoreResidenceUser', [ResidenceUserController::class, 'store']);
Route::put('/UpdateResidenceUser/{id}', [ResidenceUserController::class, 'update']);
Route::delete('/DeleteResidenceUser/{id}', [ResidenceUserController::class, 'destroy']);
