<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('suppliers')->group(function (){
    require __DIR__.'\Supplier\supplier.php';
});



require __DIR__.'\Product\product.php';
require __DIR__.'\Brand\brand.php';
require __DIR__.'\Rol\rol.php';
require __DIR__.'\Privilege\privilege.php';
require __DIR__.'\Catalog\catalog.php';
require __DIR__.'\Inventory\inventory.php';
require __DIR__.'\RolPrivilege\rol_privilege.php';
require __DIR__.'\UserRol\user_rol.php';
