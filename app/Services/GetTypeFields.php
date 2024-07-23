<?php

namespace App\Services;

class GetTypeFields
{
    public static function get_type()
    {
        $type_field = [
            'string' => 'Строка',
            'bool' => 'Логический тип',
            'editor' => 'Редактор',
            'textarea' => 'Текстовое поле',
            'file' => 'Файл',
            'image' => 'Изображение',
            'number' => 'Числовое значение'

        ];
        return $type_field;
    }
}
