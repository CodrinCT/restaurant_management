<?php

namespace App\Domain\User\Services;

use App\Domain\User\Models\User;

class UserService
{
    public function all()
    {
        return User::all();
    }

    public function create(array $data)
    {
        return User::create($data);
    }
}