<?php
namespace App\Services\Options;

use Illuminate\Support\Facades\File;
use App\Models\Setting;

class GetListLang{
    public static function get()
    {
        $availableLocales = config('app.available_locales');
        return $availableLocales;
    }
}