<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class FrontCategoryController extends Controller
{
    public function show($slug)
    {

        $category = Category::where('slug', $slug)->first()->toArray();

        if (!$category) {
            abort(404);
        }


        $template = $category['template'];
        $templatePath = "web/category/{$template}";
        if (View::exists($templatePath)) {
            return view($templatePath, ['category' => $category]);
        } else {
            $message = "Шаблон {$template} не найден";
            return response($message, 404);
        }

        return view("web/category/{$template}", ['category' => $category]);
    }
}
