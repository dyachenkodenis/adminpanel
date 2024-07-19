<?php


namespace App\Services;

use App\Models\WebComponent;
use App\Models\CustomField;
class GetComponentFields
{

    public static function component_field($id)
    {

        //список полей виджетов
        $cf = CustomField::where('page_id', $id)->find();


          foreach($cf->web_components->toArray() as $key){
              echo $key['id'];
          }
          return;
    }

}
