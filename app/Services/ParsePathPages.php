<?php 

namespace App\Services;

use Illuminate\Support\Facades\File;

class ParsePathPages
{
    public static function path()
    {
        $files = File::files(base_path('/resources/views/web/pages'));
        return $files;
    }
}