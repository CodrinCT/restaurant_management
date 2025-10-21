<?php

namespace App\Domain\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\User\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $service) {}

    public function index()
    {
        return inertia('User/Index', [
            'items' => $this->service->all()
        ]);
    }

    public function store(Request $request)
    {
        $this->service->create($request->all());
        return back();
    }
}