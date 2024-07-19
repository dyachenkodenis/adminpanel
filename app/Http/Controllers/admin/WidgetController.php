<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Widget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Services\ParsePathWidgets;

class WidgetController extends Controller
{
    public function index(Request $request)
    {
        $perWidget = 10;
        $widgets = Widget::latest()->paginate($perWidget);
        $currentWidget = $request->input('widget', 1);
        $startIndex = ($currentWidget - 1) * $perWidget;

        return view('admin.widget.index', [
            'widgets' => $widgets,
            'i' => $startIndex
        ]);
    }

    public function create()
    {
        $files = ParsePathWidgets::path();
        return view('admin.widget.create', compact('files'));
    }


    public function store(Request $request, Widget $widget)
    {

      
        $request->validate([
            'title' => 'required|unique:widget,title',          
            'template' => 'required|string|unique:widget,template',
            'thumbnail' => '',
        ]);
 

        Widget::create([
            'title' => $request->title,
            'template' =>  $request->template,
            'thumbnail' => $request->thumbnail
        ]);

        return redirect()->route('admin.widget.index')
            ->with('success', 'Виджет успешно создан.');
    }

    public function show(Widget $widget)
    {
        return view('admin.widget.show', compact('widget'));
    }

    public function edit(Widget $widget)
    {
        $files = ParsePathWidgets::path();
        return view('admin.widget.edit', compact('widget', 'files'));
    }

    public function update(Request $request, Widget $widget)
    {
        
       
        try {

            $widget->update([
                'title' => $request->setting['title'],
               // 'jsonvalue' => $request->all(),
                'template' => $request->setting['template'],
                'thumbnail' => $request->setting['thumbnail'],
               
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

    public function destroy(Widget $widget)
    {


        $widget->delete();


        return redirect()->route('admin.widget.index')
            ->with('success', 'Виджет успешно удален.');
    }

   

   
}
