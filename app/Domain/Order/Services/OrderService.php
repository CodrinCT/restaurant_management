<?php

namespace App\Domain\Order\Services;

use App\Domain\Order\Models\Order;

class OrderService
{
    public function all()
    {
        return Order::all();
    }

    public function create(array $data)
    {
        return Order::create($data);
    }
}