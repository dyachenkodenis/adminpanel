<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClearAllController extends Controller
{
    public function clear()
    {      
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        return "Кеш успешно очищен";
    }
}
