<?php

namespace App\Domain\Inventory\Providers;

use Illuminate\Support\ServiceProvider;

class InventoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind Inventory services here
    }

    public function boot(): void
    {
        // Bootstrap Inventory domain features
    }
}