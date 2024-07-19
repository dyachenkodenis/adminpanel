<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Work;

class FrontWorkController extends Controller
{
    public function show($slug)
    {

        $work = Work::where('slug', $slug)->first()->toArray();

        if (!$work) {
            abort(404);
        }


        $template = $work['template'];
        $templatePath = "web/work/{$template}";
        if (View::exists($templatePath)) {
            return view($templatePath, ['work' => $work]);
        } else {
            $message = "Шаблон {$template} не найден";
            return response($message, 404);
        }

        return view("web/work/{$template}", ['work' => $work]);
    }
}
 