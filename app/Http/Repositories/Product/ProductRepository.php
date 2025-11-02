<?php

namespace App\Http\Repositories\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function all()
    {
        return $this->product->get();
    }

    public function find($id)
    {
        return $this->product->find($id);
    }

    public function create(array $data)
    {
        return $this->product->create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->find($id);
        $product?->update($data);
        return $product;
    }
}