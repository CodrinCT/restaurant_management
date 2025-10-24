<?php

namespace App\Domain\Product\Services;

use App\Domain\Product\Models\Product;

class ProductService
{
    public function all()
    {
        return Product::all();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }
}