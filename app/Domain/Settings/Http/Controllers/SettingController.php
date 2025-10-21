<?php

namespace App\Domain\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Settings\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(protected SettingService $service) {}

    public function index()
    {
        return inertia('Settings/Index', [
            'items' => $this->service->all()
        ]);
    }

    public function store(Request $request)
    {
        $this->service->create($request->all());
        return back();
    }
}