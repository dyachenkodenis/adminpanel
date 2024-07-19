<?php

namespace App\Services;

use App\Models\Widget;

class GetWidgetTemplateFromId
{
    public static function get_template($id)
    {
        
        $data = Widget::where('id', $id)->get();
        if(isset($data) && $data):
            return $data->toArray();
        endif;
    }
}
