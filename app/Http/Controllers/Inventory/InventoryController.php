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
        return $this->utilResponse->succesResponse(InventoryResource::collection($this->inventoryRepository->all()), 'Inventario obtenido correctamente');
    }

    public function show($id)
    {
        $inventory = $this->inventoryRepository->find($id);
        if ($inventory) {
            return $this->utilResponse->succesResponse(new InventoryResource($inventory), 'Registro de inventario encontrado');
        }
        return $this->utilResponse->errorResponse('No existe el registro de inventario');
    }

    public function store(InventoryRequest $request)
    {
        $inventory = $this->inventoryRepository->create($request->validated());
        if ($inventory) {
            return $this->utilResponse->succesResponse(new InventoryResource($inventory), 'Registro de inventario creado correctamente', 201);
        }
        return $this->utilResponse->errorResponse('Error al crear el registro de inventario');
    }

    public function update(InventoryRequest $request, $id)
    {
        $inventory = $this->inventoryRepository->update($id, $request->validated());
        return $this->utilResponse->succesResponse(new InventoryResource($inventory), 'Registro de inventario actualizado correctamente');
    }

    public function destroy($id)
    {
        if ($this->inventoryRepository->delete($id)) {
            return $this->utilResponse->succesResponse(null, 'Registro de inventario eliminado correctamente');
        }
        return $this->utilResponse->errorResponse('No se pudo eliminar el registro de inventario o no existe');
    }
}
