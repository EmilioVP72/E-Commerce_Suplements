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


}
