<?php

namespace App\Domain\Billing\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Billing\Services\BillingService;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function __construct(protected BillingService $service) {}

    public function index()
    {
        return inertia('Billing/Index', [
            'items' => $this->service->all()
        ]);
    }

    public function store(Request $request)
    {
        $this->service->create($request->all());
        return back();
    }
}