<?php

namespace App\Domain\Table\Services;

use App\Domain\Table\Models\Table;

class TableService
{
    public function all()
    {
        return Table::all();
    }

    public function create(array $data)
    {
        return Table::create($data);
    }
}