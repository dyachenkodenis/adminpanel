<?php
namespace App\Services;

use App\Models\CustomField;

class GetCustomField
{
    public static function component_field($id)
    {
        $cf = CustomField::where('web_components_id', $id)->find($id);
        dd($cf);
    }


}
