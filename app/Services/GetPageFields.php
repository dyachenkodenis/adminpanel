<?php

namespace App\Services;

use App\Models\Page;

class GetPageFields
{
    public static function get_page_fields($id)
    {
        $page = Page::find($id);
        $custom_fields = $page->custom_fields;
        return $custom_fields;
    }

    public static function get_custon_fields_for_page($id)
    {
        $page = Page::find($id);
        // список полей страницы
        $custom_fields_page = $page->custom_fields;
        foreach ($custom_fields_page as $item) {
            if (isset($item['jsonvalue']) && is_object($item['jsonvalue'])) {
                $newArray[] = $item['jsonvalue'];
            }
        }
        return $newArray;
    }
}
