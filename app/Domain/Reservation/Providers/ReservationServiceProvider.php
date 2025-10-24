<?php

namespace App\Domain\Reservation\Providers;

use Illuminate\Support\ServiceProvider;

class ReservationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind Reservation services here
    }

    public function boot(): void
    {
        // Bootstrap Reservation domain features
    }
}