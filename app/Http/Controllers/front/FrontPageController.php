<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\View;

class FrontPageController extends Controller
{
    public function show($slug)
    {

        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            abort(404);
        }

        $page = $page->toArray();

        $template = $page['template'];
        $templatePath = "web/pages/{$template}";

        if (View::exists($templatePath)) {
            return view($templatePath, ['page' => $page]);
        } else {
            $message = "Шаблон {$template} не найден";
            return response($message, 404);
        }
    }

    public function front_page()
    {
        $page = Page::where('template', 'front_page')->first();

        if (!$page) {
            abort(404);
        }

        $page = $page->toArray();


        $templatePath = "web/pages/front_page";

        if (View::exists($templatePath)) {

            $jsondata = $page['jsonvalue'];
            return view($templatePath, ['page' => $page, 'json' => $jsondata]);
        } else {
            $message = "Шаблон главной страницы front_page не найден";
            return response($message, 404);
        }
    }
}
