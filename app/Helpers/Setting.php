<?php

namespace App\Helpers;

use App\Models\Setting;

class GlobalSetting
{
    public static function key($key)
    {
        $setthing = Setting::where('key', $key)->first();
        return $setthing->value;
    }
}