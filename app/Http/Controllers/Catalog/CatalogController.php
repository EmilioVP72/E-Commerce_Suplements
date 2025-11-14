<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\CatalogRequest;
use App\Http\Resources\Catalog\CatalogResource;
use App\Http\Repositories\Catalog\CatalogRepository;
use App\Traits\UtilResponse;

class CatalogController extends Controller
{
    private $utilResponse;
    private $catalogRepository;

    public function __construct(UtilResponse $utilResponse, CatalogRepository $catalogRepository)
    {
        $this->utilResponse = $utilResponse;
        $this->catalogRepository = $catalogRepository;
    }

    public function index()
    {
        return $this->utilResponse->succesResponse(CatalogResource::collection($this->catalogRepository->all()), 'Catálogos obtenidos correctamente');
    }

    public function show($id)
    {
        $catalog = $this->catalogRepository->find($id);
        if ($catalog) {
            return $this->utilResponse->succesResponse(new CatalogResource($catalog), 'Catálogo encontrado');
        }
        return $this->utilResponse->errorResponse('No existe el catálogo');
    }

    public function store(CatalogRequest $request)
    {
        $catalog = $this->catalogRepository->create($request->validated());
        if ($catalog) {
            return $this->utilResponse->succesResponse(new CatalogResource($catalog), 'Catálogo creado correctamente', 201);
        }
        return $this->utilResponse->errorResponse('Error al crear el catálogo');
    }

    public function update(CatalogRequest $request, $id)
    {
        $catalog = $this->catalogRepository->update($id, $request->validated());
        return $this->utilResponse->succesResponse(new CatalogResource($catalog), 'Catálogo actualizado correctamente');
    }

    public function destroy($id)
    {
        if ($this->catalogRepository->delete($id)) {
            return $this->utilResponse->succesResponse(null, 'Catálogo eliminado correctamente');
        }
        return $this->utilResponse->errorResponse('No se pudo eliminar el catálogo o no existe');
    }
}
