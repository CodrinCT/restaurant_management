<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(
        protected ProductRepository $repository
    ) {}

    public function getAll()
    {
        return $this->repository->all();
    }

    /**
     * Retrieve a product by id.
     *
     * @param int $id
     * @return \App\Models\Product
     */
    public function getById($id)
    {
        return $this->repository->find($id);
    }



    /**
     * Create a new product in the database.
     *
     * @param array $data
     * @return \App\Models\Product
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }
    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
