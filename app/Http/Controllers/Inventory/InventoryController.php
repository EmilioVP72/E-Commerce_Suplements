<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\InventoryRequest;
use App\Http\Resources\Inventory\InventoryResource;
use App\Http\Repositories\Inventory\InventoryRepository;
use App\Traits\UtilResponse;

class InventoryController extends Controller
{
    private $utilResponse;
    private $inventoryRepository;

    public function __construct(UtilResponse $utilResponse, InventoryRepository $inventoryRepository)
    {
        $this->utilResponse = $utilResponse;
        $this->inventoryRepository = $inventoryRepository;
    }

    public function index()
    {
        return $this->utilResponse->succesResponse(
            InventoryResource::collection($this->inventoryRepository->all()),
            'Inventarios obtenidos correctamente'
        );
    }

    public function show($id)
    {
        $inventory = $this->inventoryRepository->find($id);

        if ($inventory) {
            return $this->utilResponse->succesResponse(
                new InventoryResource($inventory),
                'Inventario encontrado'
            );
        }

        return $this->utilResponse->errorResponse('No existe el inventario');
    }

    public function store(InventoryRequest $request)
    {
        $inventory = $this->inventoryRepository->create($request->validated());

        if ($inventory) {
            return $this->utilResponse->succesResponse(
                new InventoryResource($inventory),
                'Inventario creado correctamente',
                201
            );
        }

        return $this->utilResponse->errorResponse('Error al crear el inventario');
    }

    public function update(InventoryRequest $request, $id)
    {
        $inventory = $this->inventoryRepository->update($id, $request->validated());

        if ($inventory) {
            return $this->utilResponse->succesResponse(
                new InventoryResource($inventory),
                'Inventario actualizado correctamente'
            );
        }

        return $this->utilResponse->errorResponse('No se pudo actualizar el inventario o no existe');
    }

    public function destroy($id)
    {
        if ($this->inventoryRepository->delete($id)) {
            return $this->utilResponse->succesResponse(null, 'Inventario eliminado correctamente');
        }

        return $this->utilResponse->errorResponse('No se pudo eliminar el inventario o no existe');
    }
}
