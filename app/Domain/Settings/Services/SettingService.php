<?php

namespace App\Domain\Settings\Services;

use App\Domain\Settings\Models\Setting;

class SettingService
{
    public function all()
    {
        return Setting::all();
    }

    public function create(array $data)
    {
        return Setting::create($data);
    }
}