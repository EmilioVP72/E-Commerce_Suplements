<?php

namespace App\Http\Controllers\TransactionDetail;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionDetail\TransactionDetailRequest;
use App\Http\Resources\TransactionDetail\TransactionDetailResource;
use App\Http\Repositories\TransactionDetail\TransactionDetailRepository;
use App\Traits\UtilResponse;

class TransactionDetailController extends Controller
{
    private $utilResponse;
    private $transactionDetailRepository;

    public function __construct(UtilResponse $utilResponse, TransactionDetailRepository $transactionDetailRepository)
    {
        $this->utilResponse = $utilResponse;
        $this->transactionDetailRepository = $transactionDetailRepository;
    }

    public function index()
    {
        return $this->utilResponse->succesResponse(TransactionDetailResource::collection($this->transactionDetailRepository->all()), 'Detalles de transacción obtenidos correctamente');
    }

    public function show($id)
    {
        $transactionDetail = $this->transactionDetailRepository->find($id);
        if ($transactionDetail) {
            return $this->utilResponse->succesResponse(new TransactionDetailResource($transactionDetail), 'Detalle de transacción encontrado');
        }
        return $this->utilResponse->errorResponse('No existe el detalle de transacción');
    }

    public function store(TransactionDetailRequest $request)
    {
        $transactionDetail = $this->transactionDetailRepository->create($request->validated());
        if ($transactionDetail) {
            return $this->utilResponse->succesResponse(new TransactionDetailResource($transactionDetail), 'Detalle de transacción creado correctamente', 201);
        }
        return $this->utilResponse->errorResponse('Error al crear el detalle de transacción');
    }

    public function update(TransactionDetailRequest $request, $id)
    {
        $transactionDetail = $this->transactionDetailRepository->update($id, $request->validated());
        return $this->utilResponse->succesResponse(new TransactionDetailResource($transactionDetail), 'Detalle de transacción actualizado correctamente');
    }

    public function destroy($id)
    {
        if ($this->transactionDetailRepository->delete($id)) {
            return $this->utilResponse->succesResponse(null, 'Detalle de transacción eliminado correctamente');
        }
        return $this->utilResponse->errorResponse('No se pudo eliminar el detalle de transacción o no existe');
    }
}
