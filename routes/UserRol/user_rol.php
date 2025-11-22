<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRol\UserRolController;

/*
|--------------------------------------------------------------------------
| API Routes User-Rol
|--------------------------------------------------------------------------
|*/

Route::get('/user/{id_user}/roles', [UserRolController::class, 'getRolesByUser']);
Route::post('/user-roles/assign', [UserRolController::class, 'assignRol']);
Route::delete('/user-roles/revoke', [UserRolController::class, 'revokeRol']);
