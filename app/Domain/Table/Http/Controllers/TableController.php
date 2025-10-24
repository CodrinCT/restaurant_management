<?php

namespace App\Domain\Table\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Table\Services\TableService;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function __construct(protected TableService $service) {}

    public function index()
    {
        return inertia('Table/Index', [
            'items' => $this->service->all()
        ]);
    }

    public function store(Request $request)
    {
        $this->service->create($request->all());
        return back();
    }
}