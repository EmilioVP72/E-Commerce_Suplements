<?php

namespace App\Http\Controllers\BrandCatalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandCatalog\BrandCatalogRequest;
use App\Http\Resources\BrandCatalog\BrandCatalogResource;
use App\Http\Repositories\BrandCatalog\BrandCatalogRepository;
use App\Traits\UtilResponse;

class BrandCatalogController extends Controller
{
    private $utilResponse;
    private $brandCatalogRepository;

    public function __construct(UtilResponse $utilResponse, BrandCatalogRepository $brandCatalogRepository)
    {
        $this->utilResponse = $utilResponse;
        $this->brandCatalogRepository = $brandCatalogRepository;
    }

    public function index()
    {
        return $this->utilResponse->succesResponse(BrandCatalogResource::collection($this->brandCatalogRepository->all()), 'Marcas de catálogo obtenidas correctamente');
    }

    public function show($id)
    {
        $brandCatalog = $this->brandCatalogRepository->find($id);
        if ($brandCatalog) {
            return $this->utilResponse->succesResponse(new BrandCatalogResource($brandCatalog), 'Marca de catálogo encontrada');
        }
        return $this->utilResponse->errorResponse('No existe la marca de catálogo');
    }

    public function store(BrandCatalogRequest $request)
    {
        $brandCatalog = $this->brandCatalogRepository->create($request->validated());
        if ($brandCatalog) {
            return $this->utilResponse->succesResponse(new BrandCatalogResource($brandCatalog), 'Marca de catálogo creada correctamente', 201);
        }
        return $this->utilResponse->errorResponse('Error al crear la marca de catálogo');
    }

    public function update(BrandCatalogRequest $request, $id_brand, $id_catalog)
    {
        $brandCatalog = $this->brandCatalogRepository->update($id_brand, $id_catalog, $request->validated());
        if ($brandCatalog) {
            return $this->utilResponse->succesResponse(new BrandCatalogResource($brandCatalog), 'Relación actualizada correctamente');
        }
        return $this->utilResponse->errorResponse('No se pudo actualizar la relación');
    }


    public function destroy($id_brand, $id_catalog)
    {
        if ($this->brandCatalogRepository->delete($id_brand, $id_catalog)) {
            return $this->utilResponse->succesResponse(null, 'Marca de catálogo eliminada correctamente');
        }
        return $this->utilResponse->errorResponse('No se pudo eliminar la marca de catálogo o no existe');
    }

}