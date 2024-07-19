<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Work;
use App\Services\SlugGenerator;
use Illuminate\Support\Facades\File;
use App\Models\Widget;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class WorkController extends Controller
{
    public function index(Request $request)
    {
        $perWork = 10;
        $work = Work::latest()->paginate($perWork);
        $currentWork = $request->input('work', 1);
        $startIndex = ($currentWork - 1) * $perWork;

        return view('admin.work.posts.index', [
            'work' => $work,
            'i' => $startIndex
        ]);
    }

    public function create()
    {
       //$files = ParsePathPages::path();
        return view('admin.work.posts.create');
    }


    public function store(Request $request, Work $work)
    {

        $request_data = $request->validate([
            'name_work' => 'required|unique:work,title|max:150',
            'template' => ''
        ]);


        Work::create([
            'title' => $request->name_work,
            'slug' => [SlugGenerator::get_permalink($request['name_work'])],
            'template' => $request['template_work']
        ]);

        return redirect()->route('admin.work.index')
        ->with('success', 'Страница успешно создана.');
    }

    public function show(Work $work)
    {
        return view('admin.work.show', compact('work'));
    }

    public function edit(Work $work)
    {
        //$files = ParsePathPages::path();
        return view('admin.work.edit', compact('work'));
    }

    public function update(Request $request, Work $work)
    {


        try {

            $work->update([
                'title' => $request->setting['work_name'],
                'jsonvalue' => $request->all(),
                'template' => $request->setting['template_work'],
                'status' => $request->setting['select_public'],
                'slug' => $request->setting['slug_work']
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

    public function destroy(Work $work)
    {


        //File::delete(app_path("/Http/Controllers/{$page->template}Controller.php"));
        $work->delete();


        return redirect()->route('admin.work.index')
        ->with('success', 'Страница успешно удалена.');
    }
}
 