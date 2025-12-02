<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShoppingCart\AddToCartRequest;
use App\Http\Requests\ShoppingCart\UpdateCartItemRequest;
use App\Http\Resources\ShoppingCart\ShoppingCartResource;
use App\Http\Repositories\ShoppingCart\ShoppingCartRepository;
use App\Traits\UtilResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ShoppingCartController extends Controller
{
    private $utilResponse;
    private $repository;

    public function __construct(UtilResponse $utilResponse, ShoppingCartRepository $repository)
    {
        $this->utilResponse = $utilResponse;
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

            return $this->utilResponse->succesResponse(null, 'Producto añadido al carrito correctamente', 201);
        } catch (\Exception $e) {
            return $this->utilResponse->errorResponse($e->getMessage(), 400);
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

            return $this->utilResponse->succesResponse(null, 'Carrito actualizado correctamente');
        } catch (\Exception $e) {
            return $this->utilResponse->errorResponse($e->getMessage(), 400);
        }
    }

    public function remove($cartId)
    {
        try {
            $userId = Auth::id();
            $this->repository->removeFromCart($userId, $cartId);

            return $this->utilResponse->succesResponse(null, 'Producto removido del carrito');
        } catch (\Exception $e) {
            return $this->utilResponse->errorResponse($e->getMessage(), 400);
        }
    }

    public function clear()
    {
        try {
            $userId = Auth::id();
            $this->repository->clearCart($userId);

            return $this->utilResponse->succesResponse(null, 'Carrito vaciado correctamente');
        } catch (\Exception $e) {
            return $this->utilResponse->errorResponse($e->getMessage(), 400);
        }
    }

    public function getCartData()
    {
        $userId = Auth::id();
        $items = $this->repository->getCartByUserId($userId);
        $total = $this->repository->getCartTotal($userId);

        return $this->utilResponse->succesResponse([
            'items' => ShoppingCartResource::collection($items),
            'total' => $total,
            'count' => $items->count(),
        ], 'Datos del carrito obtenidos correctamente');
    }

    public function finalizePurchase()
    {
        try {
            $userId = Auth::id();
            $items = $this->repository->getCartByUserId($userId);

            if ($items->isEmpty()) {
                return $this->utilResponse->errorResponse('El carrito está vacío', 400);
            }

            $mercadoPagoService = new \App\Services\MercadoPagoService();
            $preference = $mercadoPagoService->createPreference($items->toArray(), $userId);

            return redirect($preference->init_point);
        } catch (\Exception $e) {
            return $this->utilResponse->errorResponse($e->getMessage(), 400);
        }
    }

    public function paymentSuccess(Request $request)
    {
        $paymentId = $request->query('payment_id');
        return view('cart.success', ['payment_id' => $paymentId]);
    }

    public function paymentPending(Request $request)
    {
        return view('cart.pending');
    }

    public function paymentFailure(Request $request)
    {
        return view('cart.failure');
    }

    public function paymentNotification(Request $request)
    {
        // Webhook de MercadoPago
        $data = $request->all();
        Log::info('MercadoPago Notification: ', $data);
        return response()->json(['status' => 'received']);
    }
}