<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Widget;
use Illuminate\Http\Request;
use App\Models\WebComponent;
use Illuminate\Support\Collection;

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
        $time = time();
       
        if ($component->jsonvalue !== null ) {
            $arr = json_decode($component->jsonvalue);
            array_push( $arr, ["{$time}" => [
                'key' => $request['key'],
                'type' => $request['type'],
                'value' => $request['value']
            ]] );
        } else {
            $arr = [];
            array_push($arr, ["{$time}" => [
                'key' => $request['key'],
                'type' => $request['type'],
                'value' => $request['value']
            ]]);
        }
       
      

        try {
            $component->update([
                'jsonvalue' => json_encode($arr),
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

    public function updatefields(Request $request, WebComponent $webComponent)
    {
        //return print_r($request->toArray());
       

        $webComp = WebComponent::find($request['component_id']);
       
        $arr = json_decode($webComp->jsonvalue);

        $collection = collect($arr);

        $keyToUpdate = $request['field_id'];

        $newValue = (object) [
            'key' => $request['key'],
            'type' => $request['type'],
            'value' => $request['value'],
        ];

        // Обновляем коллекцию
        $updatedCollection = $collection->map(function ($item) use ($keyToUpdate, $newValue) {
            if (property_exists($item, $keyToUpdate)) {
                $item->$keyToUpdate = $newValue;
            }
            return $item;
        });
       
        $webComp->update([
            'jsonvalue' => json_encode($updatedCollection->all()),
        ]);

        $notification = [
            'message' => 'Элемент успешно обновлен!',
            'alert_type' => 'success',
        ];

        return response()->json($notification);
    }

    public function deletefields(Request $request, WebComponent $webComponent)
    {
             
       
        $webComp = WebComponent::find($request['id_component']);
        $arr = json_decode($webComp->jsonvalue);
        
        $collection = collect($arr);

        $keyToDelete = $request['id'];

        $filteredCollection = $collection->filter(function ($item) use ($keyToDelete) {
                return !property_exists($item, $keyToDelete);
        });

        
        $webComp->update([
                'jsonvalue' => json_encode($filteredCollection->all()),
            ]);

        $notification = [
            'message' => 'Элемент успешно удален!',
            'alert_type' => 'success',
        ];

        return response()->json($notification);
      
    }

}
