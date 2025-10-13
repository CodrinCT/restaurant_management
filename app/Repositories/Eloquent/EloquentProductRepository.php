<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\ProductRepository;

class EloquentProductRepository implements ProductRepository
{
    public function all()
    {
        return Product::all();
    }

    /**
     * Find a product by id.
     *
     * @param int $id
     * @return \App\Models\Product
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Create a new product in the database.
     *
     * @param array $data
     * @return \App\Models\Product
     */
    public function create(array $data)
    {
        return Product::create($data);
    }

    /**
     * Update a product in the database.
     *
     * @param int $id The id of the product to update.
     * @param array $data The data to update the product with.
     * @return \App\Models\Product The updated product.
     */
    public function update($id, array $data)
    {
        $order = $this->find($id);
        $order->update($data);
        return $order;
    }

    /**
     * Delete a product from the database.
     *
     * @param int $id The id of the product to delete.
     * @return bool True if the product was successfully deleted, false otherwise.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function delete($id)
    {
        $order = $this->find($id);
        $order->delete();
        return true;
    }
}
