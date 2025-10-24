<?php

namespace App\Domain\Product\Providers;

use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind Product services here
    }

    public function boot(): void
    {
        // Bootstrap Product domain features
    }
}