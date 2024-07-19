<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\WebComponent;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Services\SlugGenerator;
use Illuminate\Support\Facades\File;
use App\Services\ParsePathPages;
use App\Models\Widget;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{

    public function index(Request $request)
    {
        //$perPage = 10;
        $pages = Page::get();
        // $currentPage = $request->input('page', 1);
        // $startIndex = ($currentPage - 1) * $perPage;

        return view('admin.page.index', [
                'pages' => $pages,
               // 'i' => $startIndex
            ]);
    }

    public function create()
    {
        $files = ParsePathPages::path();
        return view('admin.page.create', compact('files'));
    }


    public function store(Request $request, Page $page)
    {

        $request_data = $request->validate([
            'name_page' => 'required|unique:pages,title|max:150',
            'template' => ''
        ]);


        Page::create([
            'title' => $request->name_page,
            'slug' => SlugGenerator::get_permalink($request['name_page']),
            'template' => $request['template_page']
        ]);

        return redirect()->route('admin.page.index')
             ->with('success', 'Страница успешно создана.');

    }

    public function show(Page $page)
    {
        return view('admin.page.show', compact('page'));

    }

    public function edit(Page $page)
    {
        //список всех виджетов
        $widget = Widget::all();
        //список компонентов относящихся к странице
        $component = $page->web_components;
        //список полей относящихся к странице
        $custom_fields = $page->custom_fields;
        $files = ParsePathPages::path();
        return view('admin.page.edit', compact('page', 'widget','files', 'component','custom_fields'));
    }

    public function update(Request $request, Page $page)
    {


        try {

            $page->update([
                    'title' => $request->setting['page_name'],
                    'jsonvalue' => $request->all(),
                    'template' => $request->setting['template_page'],
                    'widget' => $request->widget,
                    'status' => $request->setting['select_public'],
                    'slug' => $request->setting['slug_page']
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


        //File::delete(app_path("/Http/Controllers/{$page->template}Controller.php"));
        $page->delete();


        return redirect()->route('admin.page.index')
            ->with('success', 'Страница успешно удалена.');
    }




}
