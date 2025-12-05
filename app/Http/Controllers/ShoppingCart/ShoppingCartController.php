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
use App\Traits\MercadoPagoService;

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

            Log::info('USER ID: ' . $userId);
            Log::info('CART ITEMS RAW:', $items->toArray());

            if ($items->isEmpty()) {
                return $this->utilResponse->errorResponse('El carrito está vacío', 400);
            }

            $formattedItems = ShoppingCartResource::collection($items)->toArray(request());
            $mercadoPagoService = new MercadoPagoService();
            $preference = $mercadoPagoService->createPreference($formattedItems, $userId);

            return redirect($preference->init_point);

        } catch (\Exception $e) {
            return $this->utilResponse->errorResponse($e->getMessage(), 400);
        }
    }


    public function paymentSuccess(Request $request)
    {
        $paymentId = $request->query('payment_id');

        $service = new MercadoPagoService();
        $payment = $service->getPayment($paymentId);

        if ($payment['status'] !== 'approved') {
            return redirect()->route('cart.index')
                ->with('error', 'El pago aún no está aprobado.');
        }

        $this->repository->registerPurchaseFromPayment($payment);
        $this->repository->clearCart(Auth::id());
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
        Log::info('MP Notification', $request->all());
        if (!isset($request['data']['id'])) {
            return response()->json(['status' => 'ignored']);
        }

        $paymentId = $request['data']['id'];
        $service = new MercadoPagoService();
        $payment = $service->getPayment($paymentId);

        if ($payment['status'] === 'approved') {
            $this->repository->registerPurchaseFromPayment($payment);
            $this->repository->clearCart($payment['metadata']['user_id']);
        }

        return response()->json(['status' => 'processed']);
    }

}