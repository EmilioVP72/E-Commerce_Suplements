<?php

namespace App\Http\Controllers\ResidenceUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResidenceUser\ResidenceUserRequest;
use App\Http\Resources\ResidenceUser\ResidenceUserResource;
use App\Http\Repositories\ResidenceUser\ResidenceUserRepository;
use App\Traits\UtilResponse;

class ResidenceUserController extends Controller
{
    private $utilResponse;
    private $residenceUserRepository;

    public function __construct(UtilResponse $utilResponse, ResidenceUserRepository $residenceUserRepository)
    {
        $this->utilResponse = $utilResponse;
        $this->residenceUserRepository = $residenceUserRepository;
    }

    public function index()
    {
        return $this->utilResponse->succesResponse(ResidenceUserResource::collection($this->residenceUserRepository->all()), 'Residencias de usuarios obtenidas correctamente');
    }

    public function show($id)
    {
        $residenceUser = $this->residenceUserRepository->find($id);
        if ($residenceUser) {
            return $this->utilResponse->succesResponse(new ResidenceUserResource($residenceUser), 'Residencia de usuario encontrada');
        }
        return $this->utilResponse->errorResponse('No existe la residencia de usuario');
    }

    public function store(ResidenceUserRequest $request)
    {
        $residenceUser = $this->residenceUserRepository->create($request->validated());
        if ($residenceUser) {
            return $this->utilResponse->succesResponse(new ResidenceUserResource($residenceUser), 'Residencia de usuario creada correctamente', 201);
        }
        return $this->utilResponse->errorResponse('Error al crear la residencia de usuario');
    }

    public function update(ResidenceUserRequest $request, $id)
    {
        $residenceUser = $this->residenceUserRepository->update($id, $request->validated());
        return $this->utilResponse->succesResponse(new ResidenceUserResource($residenceUser), 'Residencia de usuario actualizada correctamente');
    }

    public function destroy($id)
    {
        if ($this->residenceUserRepository->delete($id)) {
            return $this->utilResponse->succesResponse(null, 'Residencia de usuario eliminada correctamente');
        }
        return $this->utilResponse->errorResponse('No se pudo eliminar la residencia de usuario o no existe');
    }
}
