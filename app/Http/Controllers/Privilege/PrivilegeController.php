<?php

namespace App\Http\Controllers\Privilege;

use App\Http\Controllers\Controller;
use App\Http\Requests\Privilege\PrivilegeRequest;
use App\Http\Resources\Privilege\PrivilegeResource;
use App\Http\Repositories\Privilege\PrivilegeRepository;
use App\Traits\UtilResponse;

class PrivilegeController extends Controller
{
    private $utilResponse;
    private $privilegeRepository;

    public function __construct(UtilResponse $utilResponse, PrivilegeRepository $privilegeRepository)
    {
        $this->utilResponse = $utilResponse;
        $this->privilegeRepository = $privilegeRepository;
    }

    public function index()
    {
        return $this->utilResponse->succesResponse(PrivilegeResource::collection($this->privilegeRepository->all()), 'Privilegios obtenidos correctamente');
    }

    public function show($id)
    {
        $privilege = $this->privilegeRepository->find($id);
        if ($privilege) {
            return $this->utilResponse->succesResponse(new PrivilegeResource($privilege), 'Privilegio encontrado');
        }
        return $this->utilResponse->errorResponse('No existe el privilegio');
    }

    public function store(PrivilegeRequest $request)
    {
        $privilege = $this->privilegeRepository->create($request->validated());
        if ($privilege) {
            return $this->utilResponse->succesResponse(new PrivilegeResource($privilege), 'Privilegio creado correctamente', 201);
        }
        return $this->utilResponse->errorResponse('Error al crear el privilegio');
    }

    public function update(PrivilegeRequest $request, $id)
    {
        $privilege = $this->privilegeRepository->update($id, $request->validated());
        return $this->utilResponse->succesResponse(new PrivilegeResource($privilege), 'Privilegio actualizado correctamente');
    }

    public function destroy($id)
    {
        if ($this->privilegeRepository->delete($id)) {
            return $this->utilResponse->succesResponse(null, 'Privilegio eliminado correctamente');
        }
        return $this->utilResponse->errorResponse('No se pudo eliminar el privilegio o no existe');
    }
}
