<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Repositories\Product\ProductRepository;
use App\Traits\UtilResponse;

class ProductController extends Controller
{
    private $utilResponse;
    private $productRepository;

    public function __construct(UtilResponse $utilResponse, ProductRepository $productRepository)
    {
        $this->utilResponse = $utilResponse;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return $this->utilResponse->succesResponse(ProductResource::collection($this->productRepository->all()),'Productos obtenidos correctamente');
    }

    public function show($id)
    {
        $product = $this->productRepository->find($id);
        if ($product) {
            return $this->utilResponse->succesResponse(new ProductResource($product), 'Producto encontrado');
        }
        return $this->utilResponse->errorResponse('No existe el producto');
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('products', 'public');
        }

        $product = $this->productRepository->create($data);

        if ($product) {
            return $this->utilResponse->succesResponse(new ProductResource($product), 'Producto creado correctamente'
            );
        }
        return $this->utilResponse->errorResponse('Error al crear el producto');
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('products', 'public');
        }

        $product = $this->productRepository->update($id, $data);

        return $this->utilResponse->succesResponse(
            new ProductResource($product),
            'Producto actualizado correctamente'
        );
    }

    public function destroy($id)
    {
        if ($this->productRepository->delete($id)) {
            return $this->utilResponse->succesResponse(null, 'Producto eliminado correctamente');
        }
        return $this->utilResponse->errorResponse('No se pudo eliminar el producto o no existe');
    }
}
