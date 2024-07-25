<?php

namespace App\Http\Controllers\admin;

use App\Actions\WebComponentDeleteFieldsActions;
use App\Actions\WebComponentUpdateFieldsActions;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Widget;
use Illuminate\Http\Request;
use App\Models\WebComponent;
use Illuminate\Support\Collection;

use App\Services\SlugGenerator;
use Illuminate\Support\Facades\File;
use App\Services\ParsePathPages;
use Exception;
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
            'title' =>  \App\Services\GetWidgetData::getTitle($request->widget_id),
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
        $time = time();
        $arr = json_decode($component->jsonvalue);

        $collection = collect($arr);

        $item = (object)["{$time}" => (object)[
                'key' => $request['key'],
                'type' => $request['type'],
                'lang' => $request['lang'],
                'value' => $request['value']
            ]];

        $array = $collection->toArray();

        
        $array[] = $item;
     

        try {
            $component->update([
                'jsonvalue' => json_encode($array),
                'page_id' => $request['page_id'],
            ]);


            $notification = [
                'message' => 'Компонент успешно обновлен!',
                'alert_type' => 'success',
            ];

            return response()->json($notification);
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

    public function updatefields(Request $request, WebComponentUpdateFieldsActions $action, WebComponent $webComponent)
    {
        try {
            $webComp = WebComponent::find($request['component_id']);

            $action->handle($request, $webComp);

            $notification = [
                'message' => 'Элемент успешно обновлен!',
                'alert_type' => 'success',
            ];

            return response()->json($notification);
        } catch ( \Exception $e ) {
            return redirect()->back()->with('error', 'Произошла ошибка: ' . $e->getMessage());
        }
        
    }

    public function deletefields(Request $request, WebComponentDeleteFieldsActions $action, WebComponent $webComponent)
    {
        try {
            $webComp = WebComponent::find($request['id_component']);

            $action->handle($request, $webComp);
        

            $notification = [
                'message' => 'Элемент успешно удален!',
                'alert_type' => 'success',
            ];

            return response()->json($notification);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Произошла ошибка: ' . $e->getMessage());
        }
    }

}
