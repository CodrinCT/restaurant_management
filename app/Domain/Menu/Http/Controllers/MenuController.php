<?php

namespace App\Domain\Menu\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Menu\Services\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct(protected MenuService $service) {}

    public function index()
    {
        return inertia('Menu/Index', [
            'items' => $this->service->all()
        ]);
    }

    public function store(Request $request)
    {
        $this->service->create($request->all());
        return back();
    }
}