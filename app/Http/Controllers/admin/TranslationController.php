<?php

namespace App\Http\Controllers\admin;

use Illuminate\Contracts\Foundation\Application;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class TranslationController extends Controller
{
    public function index()
    {
        $translations = Lang::getLoader('en');
        return view('admin.translations.index', compact('translations'));
    }

    public function update(Request $request)
    {
        foreach ($request->translations as $key => $value) {
            Lang::set(app()->getLocale() . '.' . $key, $value);
        }

        return redirect()->route('translations.index')->with('success', 'Translations updated successfully!');
    }
}
