<?php

namespace App\Domain\Menu\Services;

use App\Domain\Menu\Models\Menu;

class MenuService
{
    public function all()
    {
        return Menu::all();
    }

    public function create(array $data)
    {
        return Menu::create($data);
    }
}