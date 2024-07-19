<?php

namespace App\Services;



class GetContent
{
    public static function get_content($jsonvalue, $locale)
    {
        $arr = (array)$jsonvalue;
        print_r($arr[$locale]);
        return;
    }
}
