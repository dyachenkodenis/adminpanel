<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class DictionaryController extends Controller
{
    public function index(Request $request)
    {
        $dict = Dictionary::latest()->paginate(10);
        return view('admin.dict.index', [
            'dict' => $dict
        ]);
    }

    public function create()
    {

        return view('admin.dict.create');
    }


    public function store(Request $request, Dictionary $dict)
    {


        $request->validate([
            'key' => 'required|unique:dict',
            'value' => "",
        ]);

        $value = ['ru' => $request->key, 'uz' => $request->key, 'en' => $request->key];

        Dictionary::create([
            'key' => $request->key,
            'value' => json_encode($value),
        ]);

        return redirect()->route('admin.dict.index')
            ->with('success', 'Строка успешно добавлена.');
    }



    public function update(Request $request, Dictionary $dict)
    {


        try {

            $value = ['ru' => $request->ru, 'uz' => $request->uz, 'en' => $request->en];
            $dict->update([
                'key' => $request->key,
                'value' => $value,

            ]);



            $notification = [
                'message' => 'Строка перевода успешно обновлена!',
                'alert-type' => 'success',
            ];

            Session::flash('notification', $notification);

            return Redirect::route('admin.dict.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Произошла ошибка при обновлении: ' . $e->getMessage());
        }
    }

    public function destroy(Dictionary $dict)
    {

        $dict->delete();

        return redirect()->route('admin.dict.index')
            ->with('success', 'Строка успешно удалена.');
    }
}
 