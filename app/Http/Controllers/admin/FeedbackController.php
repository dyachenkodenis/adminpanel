<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $feedback = Feedback::get()->all();
        return view('admin.feedback.index', [
            'feedback' => $feedback          
        ]);
    }


    public function feedback(Request $request, Feedback $feedback)
    {
        $getData = $request->except('_token', '_method');
        $currentDate = now();

        Feedback::create([
            'title' => "Заявка от: $currentDate",
            'value' => json_encode($getData),
        ]);

        $notification = [
            'message' => 'Заявка успеешно отправлена',
            'alert-type' => 'success',
        ];

        return json_encode($notification);

    }
}
