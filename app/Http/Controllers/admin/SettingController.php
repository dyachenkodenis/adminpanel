<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Services\ParsePathWidgets;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $setting = Setting::get()->all();
        return view('admin.setting.index', [
            'setting' => $setting
        ]);
    }

    public function create()
    {
        $files = ParsePathWidgets::path();
        return view('admin.setting.create', compact('files'));
    }


    public function store(Request $request, Setting $setting)
    {
 
      
        $request->validate([
            'title_setting' => 'unique:settings',
            'value' => "",
        ]);

      

        Setting::create([
            'title_setting' => $request->title_setting,
            'template_widget' => $request->select_widget,
        ]);

        return redirect()->route('admin.setting.index')
            ->with('success', 'Группа настроек успешно добавлена.');
    }



    public function update(Request $request, Setting $setting)
    {

        $formData = $request->except('_token', '_method');      
        try {

           
            $setting->update([            
                'value' => $formData
            ]);



            $notification = [
                'message' => 'Настроки успешно обновлены!',
                'alert-type' => 'success',
            ];

            Session::flash('notification', $notification);

            return Redirect::route('admin.setting.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Произошла ошибка при обновлении: ' . $e->getMessage());
        }
    }

    public function destroy(Setting $setting)
    {

        $setting->delete();


        return redirect()->route('admin.setting.index')
            ->with('success', 'Настроки успешно удалены.');
    }

}
 