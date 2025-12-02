<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('suppliers')->group(function (){
    require __DIR__.'\Supplier\supplier.php';
});

Route::prefix('products')->group( function (){
    require __DIR__.'\Product\product.php';
});

Route::prefix('brands')->group( function (){
    require __DIR__.'\Brand\brand.php';
});

Route::prefix('rols')->group( function (){
    require __DIR__.'\Rol\rol.php';
});

Route::prefix('privileges')->group( function (){
    require __DIR__.'\Privilege\privilege.php';
});

Route::prefix('catalogs')->group( function (){
    require __DIR__.'\Catalog\catalog.php';
});

Route::prefix('inventories')->group( function (){
    require __DIR__.'\Inventory\inventory.php';
});

Route::prefix('rolprivileges')->group( function (){
    require __DIR__.'\RolPrivilege\rol_privilege.php';
});

Route::prefix('userrols')->group( function (){
    require __DIR__.'\UserRol\user_rol.php';
});

Route::prefix('paymentmethods')->group( function (){
    require __DIR__.'\PaymentMethod\payment_method.php';
});

Route::prefix('purchases')->group( function (){
    require __DIR__.'\Purchase\purchase.php';
});

Route::prefix('purchasedetails')->group( function (){
    require __DIR__.'\PurchaseDetail\purchase_detail.php';
});

Route::prefix('residences')->group( function (){
    require __DIR__.'\Residence\residence.php';
});

Route::prefix('residenceusers')->group( function (){
    require __DIR__.'\ResidenceUser\residence_user.php';
});

Route::prefix('transactions')->group( function (){
    require __DIR__.'\Transaction\transaction.php';
});

Route::prefix('transactiondetails')->group( function (){
    require __DIR__.'\TransactionDetail\transaction_detail.php';
});

Route::prefix('brandcatalogs')->group( function (){
    require __DIR__.'\BrandCatalog\brand_catalog.php';
});

Route::prefix('users')->group( function (){
    require __DIR__.'\User\user.php';
});

Route::prefix('shoppingcarts')->group( function (){
    require __DIR__.'\ShoppingCart\shoppingcart.php';
});
