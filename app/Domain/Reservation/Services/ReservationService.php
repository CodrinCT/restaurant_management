<?php

namespace App\Domain\Reservation\Services;

use App\Domain\Reservation\Models\Reservation;

class ReservationService
{
    public function all()
    {
        return Reservation::all();
    }

    public function create(array $data)
    {
        return Reservation::create($data);
    }
}