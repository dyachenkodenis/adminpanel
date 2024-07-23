<?php


namespace App\Services;

use App\Models\WebComponent;
use App\Models\Widget;
use App\Models\CustomField;

class GetWidgetData
{
    public static function get_title($id)
    {
        $data = Widget::find($id);
        if ($data):
            return $data->title;
        endif;
    }
    public static function get_all($id)
    {
        $data = Widget::find($id);
        if ($data):
            return $data->toArray();
        endif;
    }
    public static function get_widget_fields($id)
    {

        $fields = CustomField::where('web_components_id', $id)->get();

        if ($fields):
            return $fields->toArray();
        endif;
    }
}
