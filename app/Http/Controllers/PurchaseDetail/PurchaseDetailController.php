<?php

namespace App\Http\Controllers\PurchaseDetail;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseDetail\PurchaseDetailRequest;
use App\Http\Resources\PurchaseDetail\PurchaseDetailResource;
use App\Http\Repositories\PurchaseDetail\PurchaseDetailRepository;
use App\Traits\UtilResponse;

class PurchaseDetailController extends Controller
{
    private $utilResponse;
    private $purchaseDetailRepository;

    public function __construct(UtilResponse $utilResponse, PurchaseDetailRepository $purchaseDetailRepository)
    {
        $this->utilResponse = $utilResponse;
        $this->purchaseDetailRepository = $purchaseDetailRepository;
    }

    public function index()
    {
        return $this->utilResponse->succesResponse(PurchaseDetailResource::collection($this->purchaseDetailRepository->all()), 'Detalles de compra obtenidos correctamente');
    }

    public function show($id)
    {
        $purchaseDetail = $this->purchaseDetailRepository->find($id);
        if ($purchaseDetail) {
            return $this->utilResponse->succesResponse(new PurchaseDetailResource($purchaseDetail), 'Detalle de compra encontrado');
        }
        return $this->utilResponse->errorResponse('No existe el detalle de compra');
    }

    public function store(PurchaseDetailRequest $request)
    {
        $purchaseDetail = $this->purchaseDetailRepository->create($request->validated());
        if ($purchaseDetail) {
            return $this->utilResponse->succesResponse(new PurchaseDetailResource($purchaseDetail), 'Detalle de compra creado correctamente', 201);
        }
        return $this->utilResponse->errorResponse('Error al crear el detalle de compra');
    }

    public function update(PurchaseDetailRequest $request, $id)
    {
        $purchaseDetail = $this->purchaseDetailRepository->update($id, $request->validated());
        return $this->utilResponse->succesResponse(new PurchaseDetailResource($purchaseDetail), 'Detalle de compra actualizado correctamente');
    }

    public function destroy($id)
    {
        if ($this->purchaseDetailRepository->delete($id)) {
            return $this->utilResponse->succesResponse(null, 'Detalle de compra eliminado correctamente');
        }
        return $this->utilResponse->errorResponse('No se pudo eliminar el detalle de compra o no existe');
    }
}
