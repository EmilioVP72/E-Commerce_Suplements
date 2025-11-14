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

    public function show($id)
    {
        $rol = $this->rolRepository->find($id);
        if ($rol) {
            return $this->utilResponse->succesResponse(new RolResource($rol), 'Rol encontrado');
        }
        return $this->utilResponse->errorResponse('No existe el rol');
    }

    public function store(RolRequest $request)
    {
        $rol = $this->rolRepository->create($request->validated());
        if ($rol) {
            return $this->utilResponse->succesResponse(new RolResource($rol), 'Rol creado correctamente', 201);
        }
        return $this->utilResponse->errorResponse('Error al crear el rol');
    }

    public function update(RolRequest $request, $id)
    {
        $rol = $this->rolRepository->update($id, $request->validated());
        return $this->utilResponse->succesResponse(new RolResource($rol), 'Rol actualizado correctamente');
    }

    public function destroy($id)
    {
        if ($this->rolRepository->delete($id)) {
            return $this->utilResponse->succesResponse(null, 'Rol eliminado correctamente');
        }
        return $this->utilResponse->errorResponse('No se pudo eliminar el rol o no existe');
    }
}
