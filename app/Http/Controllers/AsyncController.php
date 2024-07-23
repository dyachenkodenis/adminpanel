<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebComponent;

class AsyncController extends Controller
{
    public function apidata()
    {
        return response()->json([
            'body' => ['message' => 'test']
        ]);
    }
}
