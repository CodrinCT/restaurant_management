<?php

namespace App\Domain\Reservation\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Reservation\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct(protected ReservationService $service) {}

    public function index()
    {
        return inertia('Reservation/Index', [
            'items' => $this->service->all()
        ]);
    }

    public function store(Request $request)
    {
        $this->service->create($request->all());
        return back();
    }
}