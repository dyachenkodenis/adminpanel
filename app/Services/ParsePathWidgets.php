<?php 

namespace App\Services;

use Illuminate\Support\Facades\File;

class ParsePathWidgets
{
    public static function path()
    {
        $files = File::files(base_path('/resources/views/components/widget'));
        return $files;
    }
}