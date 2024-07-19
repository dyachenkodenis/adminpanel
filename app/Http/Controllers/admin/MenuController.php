<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Widget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Services\ParsePathWidgets;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $perMenu = 10;
        $menu = Menu::latest()->paginate($perMenu);
        $currentMenu = $request->input('menu', 1);
        $startIndex = ($currentMenu - 1) * $perMenu;

        return view('admin.menu.index', [
            'menu' => $menu,
            'i' => $startIndex
        ]);
    
    }
 
 
    public function create()
    {
        $files = ParsePathWidgets::path();
        return view('admin.menu.create', compact('files'));
    }


    public function store(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => '',
            'template' => '',
            'jsonvalue' => ''
        ]);

        Menu::create([
            'title' => $request->title,
            'template' => $request->widget_id,
            'jsonvalue' => $request->nav_template,
        ]);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Meню успешно создано.');
    }

    public function edit(Menu $menu)
    {
        $widget = Widget::all();
        return view('admin.menu.edit', compact('menu', 'widget'));
    }


    public function update(Request $request, Menu $menu)
    {
        // $menu->update([
        //     'jsonvalue' => $request->acf
        // ]);
    }


    public function destroy(Menu $menu)
    {

        $menu->delete();

        return redirect()->route('admin.menu.index')
            ->with('success', 'Меню успешно удалено.');
    }


   
}
