<?php

namespace App\Domain\Inventory\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Inventory\Services\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct(protected InventoryService $service) {}

    public function index()
    {
        return inertia('Inventory/Index', [
            'items' => $this->service->all()
        ]);
    }

    public function store(Request $request)
    {
        $this->service->create($request->all());
        return back();
    }
}