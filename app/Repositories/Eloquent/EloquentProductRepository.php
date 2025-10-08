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

    public function find($id)
    {
        return Product::findOrFail($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $order = $this->find($id);
        $order->update($data);
        return $order;
    }

    public function delete($id)
    {
        $order = $this->find($id);
        $order->delete();
        return true;
    }
}
