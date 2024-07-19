<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;

class FeedbackValidate{

    public function feedback(Request $request)
    {
        $data = [
            'username' => $request->username,
            'userphone' => $request->userphone,            
        ];

        $rules = [            
            'username' => 'string|max:50|min:2',
          //  'userphone' => 'regex:/^\+998\d{9}$/',
        ];

        
        $validator = Validator::make($data, $rules);
        app()->setLocale('ru');

   
        if ($validator->fails()) {            
            $errors = $validator->errors()->toArray();
        
             return response()->json(['result' => 'false','message' => $errors]);   
        } else {
           
        }

    }
}