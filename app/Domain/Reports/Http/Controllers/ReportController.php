<?php

namespace App\Domain\Reports\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Reports\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(protected ReportService $service) {}

    public function index()
    {
        return inertia('Reports/Index', [
            'items' => $this->service->all()
        ]);
    }

    public function store(Request $request)
    {
        $this->service->create($request->all());
        return back();
    }
}