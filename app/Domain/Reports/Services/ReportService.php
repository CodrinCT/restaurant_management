<?php

namespace App\Domain\Reports\Services;

use App\Domain\Reports\Models\Report;

class ReportService
{
    public function all()
    {
        return Report::all();
    }

    public function create(array $data)
    {
        return Report::create($data);
    }
}