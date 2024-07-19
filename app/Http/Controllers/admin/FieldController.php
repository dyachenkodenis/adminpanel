<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class FieldController extends Controller
{
    public function index(Request $request)
    {
        $field = Field::get()->all();
        return view('admin.field.index', [
            'field' => $field          
        ]);
    }

    public function create()
    {
      
        return view('admin.field.create');
    }


    public function store(Request $request, Field $field)
    {

     
       $request->validate([
            'key' => 'required|unique:field',          
            'value' => "",
        ]);

        $value = ['ru' => $request->key, 'uz' => $request->key, 'en' => $request->key];

        Field::create([
           'key' => $request->key,
           'value' => json_encode($value),
        ]);

        return redirect()->route('admin.field.index')
            ->with('success', 'Строка успешно добавлена.');
    }

   

    public function update(Request $request, Field $field)
    {

       
        try {

            $value = ['ru' => $request->ru, 'uz' => $request->uz, 'en' => $request->en];
            $field->update([
                'key' => $request->key,
                'value' => $value,
               
            ]);



            $notification = [
                'message' => 'Строка перевода успешно обновлена!',
                'alert-type' => 'success',
            ];

            Session::flash('notification', $notification);

            return Redirect::route('admin.field.index');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Произошла ошибка при обновлении: ' . $e->getMessage());
        }
    }

    public function destroy(Field $field)
    {

        $field->delete();


        return redirect()->route('admin.field.index')
            ->with('success', 'Строка успешно удалена.');
    }

}
