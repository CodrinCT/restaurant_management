<?php

namespace App\Domain\Billing\Providers;

use Illuminate\Support\ServiceProvider;

class BillingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind Billing services here
    }

    public function boot(): void
    {
        // Bootstrap Billing domain features
    }
}