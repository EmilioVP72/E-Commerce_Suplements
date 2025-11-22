<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolPrivilege\RolPrivilegeController;

/*
|--------------------------------------------------------------------------
| API Routes Rol-Privilege
|--------------------------------------------------------------------------
|*/

Route::get('/rol/{id_rol}/privileges', [RolPrivilegeController::class, 'getPrivilegesByRol']);
Route::post('/rol-privileges/assign', [RolPrivilegeController::class, 'assignPrivilege']);
Route::delete('/rol-privileges/revoke', [RolPrivilegeController::class, 'revokePrivilege']);
