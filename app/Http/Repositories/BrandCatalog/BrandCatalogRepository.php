<?php

namespace App\Http\Repositories\BrandCatalog;

use App\Models\Brand_Catalog;

class BrandCatalogRepository
{
    protected $brandCatalog;

    public function __construct(Brand_Catalog $brandCatalog)
    {
        $this->brandCatalog = $brandCatalog;
    }

    public function all()
    {
        return $this->brandCatalog->get();
    }

    public function find($id)
    {
        return $this->brandCatalog->find($id);
    }

    public function create(array $data)
    {
        return $this->brandCatalog->create($data);
    }

    public function update($id_brand, $id_catalog, array $data)
    {
        $exists = $this->brandCatalog
            ->where('id_brand', $data['id_brand'])
            ->where('id_catalog', $data['id_catalog'])
            ->where(function ($q) use ($id_brand, $id_catalog) {
                $q->where('id_brand', '!=', $id_brand)
                ->orWhere('id_catalog', '!=', $id_catalog);
            })
            ->exists();

        if ($exists) {
            return null; 
        }

        $updated = $this->brandCatalog
            ->where('id_brand', $id_brand)
            ->where('id_catalog', $id_catalog)
            ->update([
                'id_brand' => $data['id_brand'],
                'id_catalog' => $data['id_catalog'],
                'updated_at' => now()
            ]);

        return $this->brandCatalog
            ->where('id_brand', $data['id_brand'])
            ->where('id_catalog', $data['id_catalog'])
            ->first();
    }

    public function delete($id_brand, $id_catalog)
    {
        return $this->brandCatalog
            ->where('id_brand', $id_brand)
            ->where('id_catalog', $id_catalog)
            ->delete();
    }
}
