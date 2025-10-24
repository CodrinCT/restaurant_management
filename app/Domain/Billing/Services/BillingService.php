<?php

namespace App\Domain\Billing\Services;

use App\Domain\Billing\Models\Billing;

class BillingService
{
    public function all()
    {
        return Billing::all();
    }

    public function create(array $data)
    {
        return Billing::create($data);
    }
}