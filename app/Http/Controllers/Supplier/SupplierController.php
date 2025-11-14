<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\SupplierRequest;
use App\Http\Resources\Supplier\SupplierResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Repositories\Supplier\SupplierRepository;
use App\Traits\UtilResponse;

class SupplierController extends Controller
{
    private $utilResponse;
    private $supplierRepository;

    public function __construct(UtilResponse $utilResponse, SupplierRepository $supplierRepository)
    {
        $this->utilResponse = $utilResponse;
        $this->supplierRepository = $supplierRepository;
    }

    public function index()
    {
        return $this->utilResponse->succesResponse(SupplierResource::collection($this->supplierRepository->all()),'Proveedores obtenidos correctamente');
    }

    public function show($id)
    {
        $supplier = $this->supplierRepository->find($id);
        if ($supplier) {
            return $this->utilResponse->succesResponse(new SupplierResource($supplier), 'Proveedor encontrado');
        }
        return $this->utilResponse->errorResponse('No existe el proveedor');
    }

    public function store(SupplierRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('suppliers', 'public');
            $photoContent = file_get_contents($request->file('photo')->getRealPath());
            $data['photo_base_64'] = base64_encode($photoContent);
            $data['photo'] = $path;
        }

        $supplier = $this->supplierRepository->create($data);

        if ($supplier) {
            return $this->utilResponse->succesResponse(new SupplierResource($supplier), 'Proveedor creado correctamente', 201);
        }
        return $this->utilResponse->errorResponse('Error al crear el proveedor');
    }

    public function update(SupplierRequest $request, $id)
    {
        $data = $request->validated();
        $supplier = $this->supplierRepository->find($id);

        if ($request->hasFile('photo')) {
            if ($supplier->photo) {
                Storage::disk('public')->delete($supplier->photo);
            }
            $path = $request->file('photo')->store('suppliers', 'public');
            $photoContent = file_get_contents($request->file('photo')->getRealPath());
            $data['photo_base_64'] = base64_encode($photoContent);
            $data['photo'] = $path;
        }

        $supplier = $this->supplierRepository->update($id, $data);
        return $this->utilResponse->succesResponse(new SupplierResource($supplier), 'Proveedor actualizado correctamente');
    }

    public function destroy($id)
    {
        if ($this->supplierRepository->delete($id)) {
            return $this->utilResponse->succesResponse(null, 'Proveedor eliminado correctamente');
        }
        return $this->utilResponse->errorResponse('No se pudo eliminar el proveedor o no existe');
    }
}