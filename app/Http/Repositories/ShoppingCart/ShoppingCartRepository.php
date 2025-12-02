<?php

namespace App\Http\Repositories\ShoppingCart;

use App\Models\ShoppingCart;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class ShoppingCartRepository
{
    public function getCartByUserId($userId)
    {
        return ShoppingCart::where('id_user', $userId)
            ->with(['product.inventory', 'product.brand'])
            ->get();
    }

    public function addToCart($userId, $productId, $quantity)
    {
        $product = Product::findOrFail($productId);
        $inventory = Inventory::where('id_product', $productId)->first();

        if (!$inventory || $inventory->quantity < $quantity) {
            throw new \Exception('Stock insuficiente');
        }

        $cartItem = ShoppingCart::where('id_user', $userId)
            ->where('id_product', $productId)
            ->first();

        if ($cartItem) {
            if ($inventory->quantity < $cartItem->quantity + $quantity) {
                throw new \Exception('Stock insuficiente para la cantidad solicitada');
            }
            $cartItem->increment('quantity', $quantity);
            return $cartItem;
        }

        return ShoppingCart::create([
            'id_user' => $userId,
            'id_product' => $productId,
            'quantity' => $quantity,
        ]);
    }

    public function updateCartItem($userId, $cartId, $quantity)
    {
        $cartItem = ShoppingCart::where('id_cart', $cartId)
            ->where('id_user', $userId)
            ->firstOrFail();

        $inventory = Inventory::where('id_product', $cartItem->id_product)->first();

        if (!$inventory || $inventory->quantity < $quantity) {
            throw new \Exception('Stock insuficiente');
        }

        $cartItem->update(['quantity' => $quantity]);
        return $cartItem;
    }

    public function removeFromCart($userId, $cartId)
    {
        return ShoppingCart::where('id_cart', $cartId)
            ->where('id_user', $userId)
            ->delete();
    }

    public function clearCart($userId)
    {
        return ShoppingCart::where('id_user', $userId)->delete();
    }

    public function getCartTotal($userId)
    {
        $items = $this->getCartByUserId($userId);
        return $items->sum(function ($item) {
            return $item->product->sale_price * $item->quantity;
        });
    }

    public function registerPurchaseFromPayment($payment)
    {
        $userId = $payment['metadata']['user_id'];

        $transactionId = DB::table('transaction')->insertGetId([
            'data' => json_encode($payment),
            'qr_code' => json_encode($payment['point_of_interaction'] ?? []),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $folio = 'F-' . strtoupper(uniqid());

        $purchaseId = DB::table('purchase')->insertGetId([
            'sail_date' => now(),
            'id_user' => $userId,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $items = $this->getCartByUserId($userId);

        foreach ($items as $item) {
            DB::table('purchase_detail')->insert([
                'id_purchase' => $purchaseId,
                'id_product' => $item->id_product,
                'amount' => $item->quantity,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('transaction_detail')->insert([
                'id_transaction' => $transactionId,
                'id_payment_method' => 1, // 1 = Mercado Pago
                'id_product' => $item->id_product,
                'folio' => $folio,
                'amount' => $item->quantity * $item->product->sale_price,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return $purchaseId;
    }

}