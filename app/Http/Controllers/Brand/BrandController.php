<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandRequest;
use App\Http\Resources\Brand\BrandResource;
use App\Http\Repositories\Brand\BrandRepository;
use App\Traits\UtilResponse;

class BrandController extends Controller
{
    private $utilResponse;
    private $brandRepository;

    public function __construct(UtilResponse $utilResponse, BrandRepository $brandRepository)
    {
        $this->utilResponse = $utilResponse;
        $this->brandRepository = $brandRepository;
    }

    public function index()
    {
        return $this->utilResponse->succesResponse(BrandResource::collection($this->brandRepository->all()), 'Marcas obtenidas correctamente');
    }

    public function show($id)
    {
        $brand = $this->brandRepository->find($id);
        if ($brand) {
            return $this->utilResponse->succesResponse(new BrandResource($brand), 'Marca encontrada');
        }
        return $this->utilResponse->errorResponse('No existe la marca');
    }

    public function store(BrandRequest $request)
    {
        $brand = $this->brandRepository->create($request->validated());
        if ($brand) {
            return $this->utilResponse->succesResponse(new BrandResource($brand), 'Marca creada correctamente', 201);
        }
        return $this->utilResponse->errorResponse('Error al crear la marca');
    }

    public function update(BrandRequest $request, $id)
    {
        $brand = $this->brandRepository->update($id, $request->validated());
        return $this->utilResponse->succesResponse(new BrandResource($brand), 'Marca actualizada correctamente');
    }

    public function destroy($id)
    {
        if ($this->brandRepository->delete($id)) {
            return $this->utilResponse->succesResponse(null, 'Marca eliminada correctamente');
        }
        return $this->utilResponse->errorResponse('No se pudo eliminar la marca o no existe');
    }
}