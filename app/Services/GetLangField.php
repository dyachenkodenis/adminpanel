<?php
 
namespace App\Services;

   use App\Models\Field;

    class GetLangField
    {
        public static function get_field($key, $lang = 'ru')
        {
           $field = Field::get();
           dd($field);
        }
    }
