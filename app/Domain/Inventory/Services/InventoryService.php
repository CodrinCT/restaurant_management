<?php

namespace App\Domain\Inventory\Services;

use App\Domain\Inventory\Models\Inventory;

class InventoryService
{
    public function all()
    {
        return Inventory::all();
    }

    public function create(array $data)
    {
        return Inventory::create($data);
    }
}