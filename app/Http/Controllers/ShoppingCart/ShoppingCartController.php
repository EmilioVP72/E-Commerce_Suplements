<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShoppingCart\AddToCartRequest;
use App\Http\Requests\ShoppingCart\UpdateCartItemRequest;
use App\Http\Resources\ShoppingCart\ShoppingCartResource;
use App\Http\Repositories\ShoppingCart\ShoppingCartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    protected $repository;

    public function __construct(ShoppingCartRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $userId = Auth::id();
        $items = $this->repository->getCartByUserId($userId);
        $total = $this->repository->getCartTotal($userId);

        return view('cart.index', [
            'items' => ShoppingCartResource::collection($items),
            'total' => $total,
        ]);
    }

    public function add(AddToCartRequest $request)
    {
        try {
            $userId = Auth::id();
            $this->repository->addToCart(
                $userId,
                $request->id_product,
                $request->quantity
            );

            return response()->json([
                'success' => true,
                'message' => 'Producto añadido al carrito correctamente',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function update(UpdateCartItemRequest $request, $cartId)
    {
        try {
            $userId = Auth::id();
            $this->repository->updateCartItem(
                $userId,
                $cartId,
                $request->quantity
            );

            return response()->json([
                'success' => true,
                'message' => 'Carrito actualizado correctamente',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function remove($cartId)
    {
        try {
            $userId = Auth::id();
            $this->repository->removeFromCart($userId, $cartId);

            return response()->json([
                'success' => true,
                'message' => 'Producto removido del carrito',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function clear()
    {
        try {
            $userId = Auth::id();
            $this->repository->clearCart($userId);

            return response()->json([
                'success' => true,
                'message' => 'Carrito vaciado correctamente',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function getCartData()
    {
        $userId = Auth::id();
        $items = $this->repository->getCartByUserId($userId);
        $total = $this->repository->getCartTotal($userId);

        return response()->json([
            'items' => ShoppingCartResource::collection($items),
            'total' => $total,
            'count' => $items->count(),
        ]);
    }
}