<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rol\RolController;

/*
|--------------------------------------------------------------------------
| API Routes Rol
|--------------------------------------------------------------------------
|*/

Route::get('/all', [RolController::class, 'index']);
Route::get('/OneRol/{id}', [RolController::class, 'show']);
Route::post('/StoreRol', [RolController::class, 'store']);
Route::put('/UpdateRol/{id}', [RolController::class, 'update']);
Route::delete('/DeleteRol/{id}', [RolController::class, 'destroy']);

