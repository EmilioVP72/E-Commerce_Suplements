<?php

namespace App\Http\Repositories\Catalog;

use App\Models\Catalog;

class CatalogRepository
{
    protected $catalog;

    public function __construct(Catalog $catalog)
    {
        $this->catalog = $catalog;
    }

    public function all()
    {
        return $this->catalog->get();
    }

    public function find($id)
    {
        return $this->catalog->find($id);
    }

    public function create(array $data)
    {
        return $this->catalog->create($data);
    }

    public function update($id, array $data)
    {
        $catalog = $this->find($id);
        $catalog?->update($data);
        return $catalog;
    }

    public function delete($id)
    {
        $catalog = $this->find($id);
        return $catalog?->delete();
    }
}
