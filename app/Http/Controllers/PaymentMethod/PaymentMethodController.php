<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethod\PaymentMethodRequest;
use App\Http\Resources\PaymentMethod\PaymentMethodResource;
use App\Http\Repositories\PaymentMethod\PaymentMethodRepository;
use App\Traits\UtilResponse;

class PaymentMethodController extends Controller
{
    private $utilResponse;
    private $paymentMethodRepository;

    public function __construct(UtilResponse $utilResponse, PaymentMethodRepository $paymentMethodRepository)
    {
        $this->utilResponse = $utilResponse;
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function index()
    {
        return $this->utilResponse->succesResponse(PaymentMethodResource::collection($this->paymentMethodRepository->all()), 'Métodos de pago obtenidos correctamente');
    }

    public function show($id)
    {
        $paymentMethod = $this->paymentMethodRepository->find($id);
        if ($paymentMethod) {
            return $this->utilResponse->succesResponse(new PaymentMethodResource($paymentMethod), 'Método de pago encontrado');
        }
        return $this->utilResponse->errorResponse('No existe el método de pago');
    }

    public function store(PaymentMethodRequest $request)
    {
        $paymentMethod = $this->paymentMethodRepository->create($request->validated());
        if ($paymentMethod) {
            return $this->utilResponse->succesResponse(new PaymentMethodResource($paymentMethod), 'Método de pago creado correctamente', 201);
        }
        return $this->utilResponse->errorResponse('Error al crear el método de pago');
    }

    public function update(PaymentMethodRequest $request, $id)
    {
        $paymentMethod = $this->paymentMethodRepository->update($id, $request->validated());
        return $this->utilResponse->succesResponse(new PaymentMethodResource($paymentMethod), 'Método de pago actualizado correctamente');
    }

    public function destroy($id)
    {
        if ($this->paymentMethodRepository->delete($id)) {
            return $this->utilResponse->succesResponse(null, 'Método de pago eliminado correctamente');
        }
        return $this->utilResponse->errorResponse('No se pudo eliminar el método de pago o no existe');
    }
}
