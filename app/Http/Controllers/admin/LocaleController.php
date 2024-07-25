<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Locale;

class LocaleController extends Controller
{
    public function index(Request $request)
    {
        $perWidget = 10;
        $widgets = Locale::latest()->paginate($perWidget);
        $currentWidget = $request->input('locales', 1);
        $startIndex = ($currentWidget - 1) * $perWidget;

        return view('admin.locale.index', [
            'widgets' => $widgets,
            'i' => $startIndex
        ]);
    }

    public function create()
    {
       
        return view('admin.locale.create');
    }


    public function store(Request $request, Locale $locale)
    {


        $request->validate([
            'code' => 'required|unique:locales,title',
            'name' => 'required|string|unique:locales'
        ]);


        Locale::create([
            'code' => $request->code,
            'name' =>  $request->name
        ]);

        return redirect()->route('admin.locale.index')
            ->with('success', 'Виджет успешно создан.');
    }

    public function show(Locale $locale)
    {
        return view('admin.locale.show', compact('locale'));
    }

    public function edit(Locale $locale)
    {
        return view('admin.locale.edit', compact('locale'));
    }

    public function update(Request $request, Locale $locale)
    {

        try {
            $locale->update([
                'code' => $request->setting['code'],
                'name' => $request->setting['name'],
            ]);

            $notification = [
                'message' => 'Виджет успешно обновлен!',
                'alert-type' => 'success',
            ];

            return json_encode($notification);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Произошла ошибка при обновлении виджета: ' . $e->getMessage());
        }
    }

    public function destroy(Locale $locale)
    {


        $locale->delete();


        return redirect()->route('admin.locale.index')
            ->with('success', 'Виджет успешно удален.');
    }

   

}
