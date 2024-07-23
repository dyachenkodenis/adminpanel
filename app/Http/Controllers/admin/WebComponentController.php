<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Widget;
use Illuminate\Http\Request;
use App\Models\WebComponent;


use App\Services\SlugGenerator;
use Illuminate\Support\Facades\File;
use App\Services\ParsePathPages;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class WebComponentController extends Controller
{
    public function index()
    {
        $component = WebComponent::get();
        return view('admin.component.index', compact('component'));
    }

    public function create()
    {

        return view('admin.component.create');
    }


    public function store(Request $request, WebComponent $web_component)
    {


        $request->validate([
            'title' => '',
            'page_id' => '',
            'widget_id' => ''
        ]);


        WebComponent::create([
            'title' =>  \App\Services\GetWidgetData::get_title($request->widget_id),
            'page_id' => $request->page_id,
            'widget_id' => $request->widget_id,
        ]);


        return response()->json(['result' => true, 'success' => 'Компонент успешно добавлен.']);
    }


    public function show(WebComponent $component)
    {
        return view('admin.component.show', compact('component'));
    }

    public function edit(WebComponent $component)
    {
        //список всех виджетов
        $widget = Widget::all();
        //список компонентов относящихся к странице
     
      
        $files = ParsePathPages::path();
        return view('admin.component.edit', compact( 'widget', 'files', 'component'));
    }

    public function update(Request $request, WebComponent $component)
    {

        print_r($request->toArray());
        exit;

        try {
            $component->update([
                // 'title' => $request->setting['page_name'],
                // 'jsonvalue' => $request->all(),
                // 'template' => $request->setting['template_page'],
                // 'widget' => $request->widget,
                // 'status' => $request->setting['select_public'],
                // 'slug' => $request->setting['slug_page']
            ]);


            $notification = [
                'message' => 'Запись успешно обновлена!',
                'alert-type' => 'success',
            ];

            return json_encode($notification);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Произошла ошибка при обновлении записи: ' . $e->getMessage());
        }
    }

    public function destroy(Page $page)
    {



        $page->delete();


        return redirect()->route('admin.pages.index')
            ->with('success', 'Страница успешно удалена.');
    }

    public function deleteComp(Request $request, WebComponent $webComponent)
    {

       // dd($request->toArray());
        $result = WebComponent::find($request);

        if ( $result[0]) {
            $result[0]->delete();

            $notification = [
                'message' => 'Custom field delete successfully!',
                'alert_type' => 'success',
            ];
            return response()->json($notification);
        }
    }

    public function apidata()
    {
        return response()->json(['test' => "sxsxs"]);
      
    }
}
