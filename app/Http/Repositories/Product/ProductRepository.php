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
        DB::beginTransaction();

        try {
            $product = $this->product->create($data);

            DB::commit();
            return $product;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();

        try {
            $product = $this->find($id);

            if (!$product) {
                DB::rollBack();
                return null;
            }

            $product->update($data);

            DB::commit();
            return $product;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $product = $this->find($id);

            if (!$product) {
                DB::rollBack();
                return false;
            }

            $deleted = $product->delete();

            DB::commit();
            return $deleted;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
