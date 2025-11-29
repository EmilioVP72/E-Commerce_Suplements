<?php

namespace App\Http\Controllers\Rol;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rol\RolRequest;
use App\Http\Resources\Rol\RolResource;
use App\Http\Repositories\Rol\RolRepository;
use App\Traits\UtilResponse;

class RolController extends Controller
{
    private $utilResponse;
    private $rolRepository;

    public function __construct(UtilResponse $utilResponse, RolRepository $rolRepository)
    {
        $this->utilResponse = $utilResponse;
        $this->rolRepository = $rolRepository;
    }

    public function index()
    {
        return $this->utilResponse->succesResponse(RolResource::collection($this->rolRepository->all()), 'Roles obtenidos correctamente');
    }

    public function oneRol($id)
    {
        try {
            $rol = $this->rolRepository->find($id);
            if (!$rol) {
                return $this->utilResponse->errorResponse('Rol no encontrado', 404);
            }
            return $this->utilResponse->succesResponse(new RolResource($rol), 'Rol encontrado');
        } catch (\Exception $e) {
            return $this->utilResponse->errorResponse('Error al obtener el rol: ' . $e->getMessage(), 500);
        }
    }

    public function updateRol($id, RolRequest $request)
    {
        try {
            $rol = $this->rolRepository->update($id, $request->validated());

            if (!$rol) {
                return $this->utilResponse->errorResponse('Rol no encontrado', 404);
            }

            return $this->utilResponse->succesResponse(new RolResource($rol), 'Rol actualizado con éxito');
        } catch (\Exception $e) {
            return $this->utilResponse->errorResponse('Error al actualizar el rol: ' . $e->getMessage(), 500);
        }
    }

    public function storeRol(RolRequest $request)
    {
        try {
            $rol = $this->rolRepository->create($request->validated());
            return $this->utilResponse->succesResponse(new RolResource($rol), 'Rol creado con éxito', 201);
        } catch (\Exception $e) {
            return $this->utilResponse->errorResponse('Error al crear el rol: ' . $e->getMessage(), 500);
        }
    }

    public function deleteRol($id)
    {
        try {
            $result = $this->rolRepository->delete($id);

            if (!$result) {
                return $this->utilResponse->errorResponse('Rol no encontrado', 404);
            }

            return $this->utilResponse->succesResponse(null, 'Rol eliminado con éxito');
        } catch (\Exception $e) {
            return $this->utilResponse->errorResponse('Error al eliminar el rol: ' . $e->getMessage(), 500);
        }
    }
}
