<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\TransactionRequest;
use App\Http\Resources\Transaction\TransactionResource;
use App\Http\Repositories\Transaction\TransactionRepository;
use App\Traits\UtilResponse;

class TransactionController extends Controller
{
    private $utilResponse;
    private $transactionRepository;

    public function __construct(UtilResponse $utilResponse, TransactionRepository $transactionRepository)
    {
        $this->utilResponse = $utilResponse;
        $this->transactionRepository = $transactionRepository;
    }

    public function index()
    {
        return $this->utilResponse->succesResponse(TransactionResource::collection($this->transactionRepository->all()), 'Transacciones obtenidas correctamente');
    }

    public function show($id)
    {
        $transaction = $this->transactionRepository->find($id);
        if ($transaction) {
            return $this->utilResponse->succesResponse(new TransactionResource($transaction), 'Transacción encontrada');
        }
        return $this->utilResponse->errorResponse('No existe la transacción');
    }

    public function store(TransactionRequest $request)
    {
        $transaction = $this->transactionRepository->create($request->validated());
        if ($transaction) {
            return $this->utilResponse->succesResponse(new TransactionResource($transaction), 'Transacción creada correctamente', 201);
        }
        return $this->utilResponse->errorResponse('Error al crear la transacción');
    }

    public function update(TransactionRequest $request, $id)
    {
        $transaction = $this->transactionRepository->update($id, $request->validated());
        return $this->utilResponse->succesResponse(new TransactionResource($transaction), 'Transacción actualizada correctamente');
    }

    public function destroy($id)
    {
        if ($this->transactionRepository->delete($id)) {
            return $this->utilResponse->succesResponse(null, 'Transacción eliminada correctamente');
        }
        return $this->utilResponse->errorResponse('No se pudo eliminar la transacción o no existe');
    }
}
