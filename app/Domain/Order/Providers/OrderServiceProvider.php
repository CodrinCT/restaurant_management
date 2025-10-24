<?php

namespace App\Domain\Order\Providers;

use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind Order services here
    }

    public function boot(): void
    {
        // Bootstrap Order domain features
    }
}