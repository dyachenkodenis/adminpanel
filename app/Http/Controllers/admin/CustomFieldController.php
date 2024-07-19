<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CustomField;
use Illuminate\Http\Request;

class CustomFieldController extends Controller
{
    public function index()
    {
        $customfields = CustomField::get();
        return view('admin.customfields.index', compact('customfields'));
    }

    public function create()
    {

        return view('admin.customfields.create');
    }


    public function store(Request $request, CustomField $customfields)
    {
  //  dd($request);

        $formData = $request->except('_token', '_method');
        $jsonvalue = ['key' => $request->key ?? "",
                    'type' => $request->type ?? "",
                    'value' => $request->value ?? "",
                    ];

        $request->validate([
            'page_id' => '',
            'web_components_id' => '',
            'jsonvalue' => ''
        ]);


        CustomField::create([
            'page_id' => $formData['page_id'] ?? null,
            'web_components_id' => $formData['web_components_id'] ?? null,
            'jsonvalue' => $jsonvalue,
        ]);

        $notification = [
            'message' => 'Custom field added successfully!',
            'alert_type' => 'success',
        ];

        return response()->json($notification);

    }

//    public function show(CustomField $customfields)
//    {
//        return view('admin.customfields.show', compact('customfields'));
//    }

    public function edit(CustomField $customfields)
    {
        return view('admin.customfields.edit', compact('customfields'));
    }

    public function update(Request $request, CustomField $customfields)
    {

   // dd($request);

        try {

            $customfields->update([
                'lang' => 'ru',
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

    public function destroy(CustomField $customfields)
    {

        $customfields->delete();

        return redirect()->route('admin.customfields.index')
            ->with('success', 'Страница успешно удалена.');
    }

    public function update_pages_field(Request $request, CustomField $customfields)
    {
       // dd($request->toArray());
        $result = CustomField::find($request->custom_field_id);
        //dd($result);
        $result->update([
            'jsonvalue' => ['key' => $request->key ?? "",
                            'type' => $request->type ?? "",
                            'value' => $request->value ?? ""],
        ]);

        $notification = [
            'message' => 'Custom field update successfully!',
            'alert_type' => 'success',
        ];

        return response()->json($notification);
    }
    public function delete_field(Request $request, CustomField $customfields)
    {

        $result = CustomField::find($request->id);
        $result->delete();

        $notification = [
            'message' => 'Custom field delete successfully!',
            'alert_type' => 'success',
        ];
        return response()->json($notification);
    }

}
