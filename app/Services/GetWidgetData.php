<?php


namespace App\Services;

use App\Models\WebComponent;
use App\Models\Widget;
use App\Models\CustomField;

class GetWidgetData
{
    public static function getTitle($id)
    {
        $data = Widget::find($id);
        if ( $data ) :
            return $data->title;
        endif;
    }
    public static function getAll($id)
    {
        $data = Widget::all();
       
        if ( $data ) :
            return $data->toArray();
        endif;
    }
    public static function getWidgetFields($id)
    {

        $fields = CustomField::where('web_components_id', $id)->get();

        if ( $fields ) :
            return $fields->toArray();
        endif;
    }
}
