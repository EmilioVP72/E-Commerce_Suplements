<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\PurchaseRequest;
use App\Http\Resources\Purchase\PurchaseResource;
use App\Http\Repositories\Purchase\PurchaseRepository;
use App\Traits\UtilResponse;

class PurchaseController extends Controller
{
    private $utilResponse;
    private $purchaseRepository;

    public function __construct(UtilResponse $utilResponse, PurchaseRepository $purchaseRepository)
    {
        $this->utilResponse = $utilResponse;
        $this->purchaseRepository = $purchaseRepository;
    }

    public function index()
    {
        return $this->utilResponse->succesResponse(PurchaseResource::collection($this->purchaseRepository->all()), 'Compras obtenidas correctamente');
    }

    public function show($id)
    {
        $purchase = $this->purchaseRepository->find($id);
        if ($purchase) {
            return $this->utilResponse->succesResponse(new PurchaseResource($purchase), 'Compra encontrada');
        }
        return $this->utilResponse->errorResponse('No existe la compra');
    }

    public function store(PurchaseRequest $request)
    {
        $purchase = $this->purchaseRepository->create($request->validated());
        if ($purchase) {
            return $this->utilResponse->succesResponse(new PurchaseResource($purchase), 'Compra creada correctamente', 201);
        }
        return $this->utilResponse->errorResponse('Error al crear la compra');
    }

    public function update(PurchaseRequest $request, $id)
    {
        $purchase = $this->purchaseRepository->update($id, $request->validated());
        return $this->utilResponse->succesResponse(new PurchaseResource($purchase), 'Compra actualizada correctamente');
    }

    public function destroy($id)
    {
        if ($this->purchaseRepository->delete($id)) {
            return $this->utilResponse->succesResponse(null, 'Compra eliminada correctamente');
        }
        return $this->utilResponse->errorResponse('No se pudo eliminar la compra o no existe');
    }
}
