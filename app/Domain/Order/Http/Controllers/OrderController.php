<?php

namespace App\Domain\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Order\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(protected OrderService $service) {}

    public function index()
    {
        return inertia('Order/Index', [
            'items' => $this->service->all()
        ]);
    }

    public function store(Request $request)
    {
        $this->service->create($request->all());
        return back();
    }
}