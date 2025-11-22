<?php

namespace App\Http\Controllers\Residence;

use App\Http\Controllers\Controller;
use App\Http\Requests\Residence\ResidenceRequest;
use App\Http\Resources\Residence\ResidenceResource;
use App\Http\Repositories\Residence\ResidenceRepository;
use App\Traits\UtilResponse;

class ResidenceController extends Controller
{
    private $utilResponse;
    private $residenceRepository;

    public function __construct(UtilResponse $utilResponse, ResidenceRepository $residenceRepository)
    {
        $this->utilResponse = $utilResponse;
        $this->residenceRepository = $residenceRepository;
    }

    public function index()
    {
        return $this->utilResponse->succesResponse(ResidenceResource::collection($this->residenceRepository->all()), 'Residencias obtenidas correctamente');
    }

    public function show($id)
    {
        $residence = $this->residenceRepository->find($id);
        if ($residence) {
            return $this->utilResponse->succesResponse(new ResidenceResource($residence), 'Residencia encontrada');
        }
        return $this->utilResponse->errorResponse('No existe la residencia');
    }

    public function store(ResidenceRequest $request)
    {
        $residence = $this->residenceRepository->create($request->validated());
        if ($residence) {
            return $this->utilResponse->succesResponse(new ResidenceResource($residence), 'Residencia creada correctamente', 201);
        }
        return $this->utilResponse->errorResponse('Error al crear la residencia');
    }

    public function update(ResidenceRequest $request, $id)
    {
        $residence = $this->residenceRepository->update($id, $request->validated());
        return $this->utilResponse->succesResponse(new ResidenceResource($residence), 'Residencia actualizada correctamente');
    }

    public function destroy($id)
    {
        if ($this->residenceRepository->delete($id)) {
            return $this->utilResponse->succesResponse(null, 'Residencia eliminada correctamente');
        }
        return $this->utilResponse->errorResponse('No se pudo eliminar la residencia o no existe');
    }
}
