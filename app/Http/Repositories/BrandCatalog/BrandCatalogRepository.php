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

    public function update($id, array $data)
    {
        $brandCatalog = $this->find($id);
        $brandCatalog?->update($data);
        return $brandCatalog;
    }

    public function delete($id)
    {
        $brandCatalog = $this->find($id);
        return $brandCatalog?->delete();
    }
}
