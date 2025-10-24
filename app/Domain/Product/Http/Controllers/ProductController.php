<?php

namespace App\Domain\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Product\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $service) {}

    public function index()
    {
        return inertia('Product/Index', [
            'items' => $this->service->all()
        ]);
    }

    public function store(Request $request)
    {
        $this->service->create($request->all());
        return back();
    }
}