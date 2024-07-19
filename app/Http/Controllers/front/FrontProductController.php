<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Product;

class FrontProductController extends Controller
{
    public function show($slug)
    {

        $product = Product::where('slug', $slug)->first()->toArray();

        if (!$product) {
            abort(404);
        }


        $template = $product['template'];
        $templatePath = "web/product/{$template}";
        if (View::exists($templatePath)) {
            return view($templatePath, ['product' => $product]);
        } else {
            $message = "Шаблон {$template} не найден";
            return response($message, 404);
        }

        return view("web/product/{$template}", ['product' => $product]);
    }
}
 