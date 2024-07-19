<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{

    public function index(Request $request)
    {
        $perLog = 10;
        $log = ActivityLog::latest()->paginate($perLog);
        $currentLog = $request->input('activity_log', 1);
        $startIndex = ($currentLog - 1) * $perLog;

        return view('admin.activity_log.index', [
            'log' => $log,
            'i' => $startIndex
        ]);
    }

  

}
