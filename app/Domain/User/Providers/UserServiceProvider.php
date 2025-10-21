<?php

namespace App\Domain\User\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind User services here
    }

    public function boot(): void
    {
        // Bootstrap User domain features
    }
}